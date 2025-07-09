<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\YeuCauHoanTra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class YeuCauHoanTraController extends Controller
{
    public function create($id)
    {
        $donHang = DonHang::with('yeuCauHoanTra')
            ->where('id', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        if ($donHang->yeuCauHoanTra) {
            return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
        }

        return view('client.hoantra', compact('donHang'));
    }

    public function store(Request $request, $id)
    {
        $donHang = DonHang::where('id', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        if ($donHang->yeuCauHoanTra) {
            return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
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
}
