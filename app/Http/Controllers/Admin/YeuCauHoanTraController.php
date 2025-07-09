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


    public function update(Request $request, $id)
    {
        $yeuCau = YeuCauHoanTra::findOrFail($id);

        $request->validate([
            'trang_thai' => 'required|in:cho_phe_duyet,da_phe_duyet,tu_choi,dang_van_chuyen_tra_hang,da_nhan_hang,da_hoan_tien',
        ]);

        $yeuCau->update(['trang_thai' => $request->trang_thai]);

        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }
}
