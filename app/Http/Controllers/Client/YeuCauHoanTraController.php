<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\YeuCauHoanTra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


class YeuCauHoanTraController extends Controller
{
   public function create($id)
{
    $donHang = DonHang::with('yeuCauHoanTra')
        ->where('id', $id)
        ->where('id_user', auth()->id())
        ->firstOrFail();


    if ($donHang->trang_thai === 'giao_that_bai') {
        return redirect()->route('client.orders.index')->with('error', 'Đơn giao thất bại không thể yêu cầu hoàn trả.');
    }


    if (
        $donHang->trang_thai === 'da_huy' &&
        in_array($donHang->huy_boi, ['khach_hang', 'he_thong'])
    ) {
        return redirect()->route('client.orders.index')->with('error', 'Đơn bị hủy không thể hoàn trả.');
    }

    if ($donHang->yeuCauHoanTra) {
        return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
    }


    if (
        $donHang->trang_thai === 'hoan_thanh' &&
        $donHang->id_phuong_thuc_thanh_toan != 2 && // != online
        $donHang->updated_at->diffInDays(now()) > 3
    ) {
        return redirect()->route('client.orders.index')
            ->with('error', 'Bạn chỉ có thể yêu cầu hoàn trả trong vòng 3 ngày sau khi đơn hoàn thành.');
    }

    return view('client.hoantra', compact('donHang'));
}


public function store(Request $request, $id)
{
    $donHang = DonHang::where('id', $id)
        ->where('id_user', auth()->id())
        ->firstOrFail();


    if ($donHang->trang_thai === 'giao_that_bai') {
        return redirect()->route('client.orders.index')->with('error', 'Đơn giao thất bại không thể yêu cầu hoàn trả.');
    }


    if (
        $donHang->trang_thai === 'da_huy' &&
        in_array($donHang->huy_boi, ['khach_hang', 'he_thong'])
    ) {
        return redirect()->route('client.orders.index')->with('error', 'Đơn bị hủy không thể hoàn trả.');
    }

    if ($donHang->yeuCauHoanTra) {
        return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
    }

    // ❌ Nếu không phải thanh toán online thì phải trong vòng 3 ngày
    $isOnline = $donHang->id_phuong_thuc_thanh_toan == 2;
    $daQua3Ngay = $donHang->updated_at->diffInDays(now()) > 3;

    if (!$isOnline && $daQua3Ngay) {
        return back()->with('error', 'Bạn chỉ có thể yêu cầu hoàn trả trong vòng 3 ngày kể từ khi đơn hoàn thành.');
    }

    $data = $request->validate([
        'sdt_lien_he' => 'required|max:20',
        'phuong_thuc_hoan_tien' => 'required|in:momo,bank_transfer',
        'ten_ngan_hang' => 'nullable|max:100',
        'so_tai_khoan' => 'nullable|max:50',
        'ten_chu_tai_khoan' => 'nullable|max:100',
        'ly_do' => 'nullable|string|max:1000',
    ]);

    $data['id_don_hang'] = $donHang->id;
    $data['ma_hoan_tra'] = 'HT' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $data['trang_thai'] = 'cho_phe_duyet';

    YeuCauHoanTra::create($data);

    return redirect()->route('client.orders.show', $donHang->id)
        ->with('success', 'Đã gửi yêu cầu hoàn trả thành công.');
}


    public function traHang($id)
    {
        $ycht = YeuCauHoanTra::where('id', $id)
            ->whereHas('donHang', fn($q) => $q->where('id_user', auth()->id()))
            ->firstOrFail();

        if ($ycht->trang_thai === 'da_phe_duyet') {
            $ycht->update(['trang_thai' => 'dang_van_chuyen_tra_hang']);
        }

        return redirect()->route('client.orders.index')->with('success', 'Bạn đã xác nhận gửi trả hàng.');
    }

}
