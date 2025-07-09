<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YeuCauHoanTra;
use Illuminate\Http\Request;

class YeuCauHoanTraController extends Controller
{
    public function index()
    {
        $danhSach = YeuCauHoanTra::with('donHang')->latest()->paginate(20);
        return view('admin.hoan_tra.index', compact('danhSach'));
    }

  public function show($id)
{
    $hoanTra = YeuCauHoanTra::with([
        'donHang.user',
        'donHang.diaChiNguoiDung',
        'donHang.phuongThucThanhToan',
        'donHang.chiTietDonHangs.bienTheSanPham.sanPham'
    ])->findOrFail($id);

    return view('admin.donhang.showhoantra', compact('hoanTra'));
}


public function capNhatTrangThai(Request $request, $id)
{
    $hoanTra = YeuCauHoanTra::findOrFail($id);

    $hienTai = $request->input('trang_thai_hien_tai');
    $moi = $request->input('trang_thai');

    $allowed = YeuCauHoanTra::TRANG_THAI_FLOW[$hienTai] ?? [];
    if (!in_array($moi, $allowed)) {
        return back()->withErrors(['msg' => 'Không thể cập nhật trạng thái này']);
    }

    $hoanTra->trang_thai = $moi;
    $hoanTra->save();

    return back()->with('success', 'Đã cập nhật trạng thái');
}

}
