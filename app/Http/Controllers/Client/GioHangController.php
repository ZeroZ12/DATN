<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\BienTheSanPham;

class GioHangController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {

        $gioHang = GioHang::with(['chiTietGioHangs.bienTheSanPham'])
                    ->where('id_user', Auth::id())
                    ->where('loai', 'chinh') // tùy loại bạn muốn lọc
                    ->first();

        return view('client.giohang', compact('gioHang'));
    }

    // Thêm sản phẩm vào giỏ
    public function themSanPham(Request $request)
{
    $request->validate([
        'id_san_pham' => 'required|integer',
        'id_bien_the' => 'required|integer',
        'so_luong' => 'required|integer|min:1'
    ]);

    $gioHang = GioHang::firstOrCreate([
        'id_user' => Auth::id(),
        'loai' => 'chinh',
    ]);

    // Kiểm tra sản phẩm đã tồn tại
    $chiTiet = ChiTietGioHang::where('id_gio_hang', $gioHang->id)
        ->where('id_bien_the', $request->id_bien_the)
        ->first();

    if ($chiTiet) {
        $chiTiet->so_luong += $request->so_luong;
        $chiTiet->save();
    } else {
        ChiTietGioHang::create([
            'id_gio_hang' => $gioHang->id,
            'id_product' => $request->id_san_pham,
            'id_bien_the' => $request->id_bien_the,
            'so_luong' => $request->so_luong,
            'gia' => BienTheSanPham::find($request->id_bien_the)->gia ?? 0,
        ]);
    }

    return redirect()->route('giohang.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');

}


    // Cập nhật số lượng
  public function capNhatSoLuong(Request $request, $id)
{
    $chiTiet = ChiTietGioHang::findOrFail($id);

    if ($request->action === 'increase') {
        $chiTiet->so_luong += 1;
    } elseif ($request->action === 'decrease') {
        if ($chiTiet->so_luong > 1) {
            $chiTiet->so_luong -= 1;
        }
    }

    $chiTiet->save();

    return redirect()->route('giohang.index')->with('success', 'Đã cập nhật số lượng sản phẩm');
}


    // Xóa sản phẩm khỏi giỏ
    public function xoaSanPham($id)
    {
        $chiTiet = ChiTietGioHang::findOrFail($id);
        $chiTiet->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Xóa toàn bộ giỏ hàng
    public function xoaGioHang()
    {
        $gioHang = GioHang::where('id_user', Auth::id())->where('loai', 'chinh')->first();

        if ($gioHang) {
            $gioHang->chiTietGioHangs()->delete();
            $gioHang->delete();
        }

        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }
}
