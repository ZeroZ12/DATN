<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
  public function index(Request $request)
{
    $query = DonHang::with(['user', 'diaChiNguoiDung'])->orderByDesc('created_at');

    if ($request->trang_thai === 'hoan_tra') {
        $query->whereHas('yeuCauHoanTra');
    } elseif ($request->trang_thai) {
        $query->where('trang_thai', $request->trang_thai);
    }

    $donHangs = $query->paginate(20);

    return view('admin.donhang.index', compact('donHangs'));
}


    public function show($id)
    {
       $donHang = DonHang::with([
           'user',
           'diaChiNguoiDung',
           'phuongThucThanhToan',
           'maGiamGia',
           'chiTietDonHangs.bienTheSanPham.sanPham'
        ])->findOrFail($id);

        return view('admin.donhang.show', compact('donHang'));
    }

public function capNhatTrangThai(Request $request, $id)
{
    $request->validate([
        'trang_thai' => 'required|in:' . implode(',', DonHang::TRANG_THAI),
        'trang_thai_hien_tai' => 'required|string',
    ]);

    $donHang = DonHang::findOrFail($id);

    if ($donHang->trang_thai !== $request->trang_thai_hien_tai) {
        return redirect()->back()->with('error', 'Trạng thái đơn hàng đã thay đổi. Vui lòng tải lại trang.');
    }

    if ($request->trang_thai === 'da_huy') {
        $donHang->update([
            'trang_thai' => 'da_huy',
            'huy_boi' => 'admin',
        ]);
    } else {
        $donHang->update([
            'trang_thai' => $request->trang_thai,
        ]);
    }

    return redirect()->route('admin.don-hang.index')->with('success', 'Cập nhật trạng thái thành công.');
}


}
