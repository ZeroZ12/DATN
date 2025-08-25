<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\YeuCauHoanTra;
use App\Models\AnhMinhChung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YeuCauHoanTraController extends Controller
{

    public function create($id)
    {
        $donHang = DonHang::with('yeuCauHoanTra')
            ->where('id', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        // Kiểm tra trạng thái không hợp lệ
        if ($donHang->trang_thai === 'giao_that_bai') {
            return redirect()->route('client.orders.index')->with('error', 'Đơn giao thất bại không thể hoàn trả.');
        }

        if ($donHang->trang_thai === 'da_huy' && in_array($donHang->huy_boi, ['khach_hang', 'he_thong'])) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn bị hủy không thể hoàn trả.');
        }

        if ($donHang->yeuCauHoanTra) {
            return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
        }

        if ($donHang->trang_thai === 'hoan_thanh' && $donHang->id_phuong_thuc_thanh_toan != 2 && $donHang->updated_at->diffInDays(now()) > 3) {
            return redirect()->route('client.orders.index')->with('error', 'Chỉ hoàn trả trong 3 ngày sau khi đơn hoàn thành.');
        }

        return view('client.hoantra', compact('donHang'));
    }

    // Lưu yêu cầu hoàn trả
    public function store(Request $request, $id)
    {
        $donHang = DonHang::where('id', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        // Kiểm tra trạng thái đơn
        if ($donHang->trang_thai === 'giao_that_bai') {
            return redirect()->route('client.orders.index')->with('error', 'Đơn giao thất bại không thể hoàn trả.');
        }

        if ($donHang->trang_thai === 'da_huy' && in_array($donHang->huy_boi, ['khach_hang', 'he_thong'])) {
            return redirect()->route('client.orders.index')->with('error', 'Đơn bị hủy không thể hoàn trả.');
        }

        if ($donHang->yeuCauHoanTra) {
            return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
        }

        $isOnline = $donHang->id_phuong_thuc_thanh_toan == 2;
        $daQua3Ngay = $donHang->updated_at->diffInDays(now()) > 3;

        if (!$isOnline && $daQua3Ngay) {
            return back()->with('error', 'Chỉ hoàn trả trong vòng 3 ngày kể từ khi hoàn thành.');
        }

        // Validate dữ liệu
        $data = $request->validate([
            'sdt_lien_he' => 'required|max:20',
            'phuong_thuc_hoan_tien' => 'required|in:momo,bank_transfer',
            'ten_ngan_hang' => 'nullable|max:100',
            'so_tai_khoan' => 'nullable|max:50',
            'ten_chu_tai_khoan' => 'nullable|max:100',
            'ly_do' => 'nullable|string|max:1000',
            'anh_minh_chung.*' => 'nullable|image|max:2048',
        ]);

        // Lưu yêu cầu hoàn trả
        $data['id_don_hang'] = $donHang->id;
        $data['ma_hoan_tra'] = 'HT' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $data['trang_thai'] = 'cho_phe_duyet';

        $yeuCau = YeuCauHoanTra::create($data);

        // Lưu ảnh minh chứng (nhiều ảnh)
        if ($request->hasFile('anh_minh_chung')) {
            foreach ($request->file('anh_minh_chung') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('minhchung', 'public');
                    AnhMinhChung::create([
                        'id_yeu_cau_hoan_tra' => $yeuCau->id,
                        'duong_dan' => '/storage/' . $path,
                    ]);
                }
            }
        }

        return redirect()->route('client.orders.index')
            ->with('success', 'Yêu cầu hoàn trả đã được gửi.');
    }

    // Xác nhận đã gửi trả hàng
  public function traHang($id)
{
    $ycht = YeuCauHoanTra::where('id', $id)
        ->whereHas('donHang', fn ($q) => $q->where('id_user', auth()->id()))
        ->firstOrFail();

    if ($ycht->trang_thai === 'da_phe_duyet') {
        $ycht->update([
            'trang_thai' => 'dang_van_chuyen_tra_hang',
            'thoi_gian_tra_hang' => now(),
        ]);
    }

    return redirect()->route('client.orders.index')->with('success', 'Bạn đã xác nhận gửi trả hàng.');
}

}
