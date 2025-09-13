<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateDanhGiaSanPhamRequest;
use App\Models\DanhGiaSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Requests\Client\StoreDanhGiaSanPhamRequest;
use Illuminate\Support\Facades\Auth;

class DanhGiaSanPhamController extends Controller
{
    public function create($productId)
    {
        $sanPham = SanPham::findOrFail($productId);
        $daDanhGia = DanhGiaSanPham::where('id_product', $productId)
            ->where('id_user', Auth::id())
            ->exists();

        if ($daDanhGia) {
            return redirect()->route('client.orders.index')->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        return view('client.reviews.create', compact('sanPham'));
    }

    public function store(StoreDanhGiaSanPhamRequest $request)
    {
        $existingReview = DanhGiaSanPham::where('id_product', $request->id_product)
            ->where('id_user', Auth::id())
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        try {
            DanhGiaSanPham::create([
                'id_product' => $request->id_product,
                'id_user' => Auth::id(),
                'so_sao' => $request->so_sao,
                'binh_luan' => $request->binh_luan,
                'trang_thai' => 'cho_duyet',
            ]);

            return redirect()->route('client.orders.index')->with('success', 'Cảm ơn bạn đã gửi đánh giá. Đánh giá của bạn sẽ được hiển thị sau khi duyệt!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại.');
        }
    }

    public function update(UpdateDanhGiaSanPhamRequest $request, DanhGiaSanPham $danhGiaSanPham)
    {
        try {
            $danhGiaSanPham->so_sao = $request->so_sao;
            $danhGiaSanPham->binh_luan = $request->binh_luan;
            $danhGiaSanPham->trang_thai = 'cho_duyet';

            $danhGiaSanPham->save();

            return back()->with('success', 'Đánh giá của bạn đã được cập nhật và sẽ được hiển thị sau khi duyệt lại!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật đánh giá. Vui lòng thử lại.');
        }
    }

    public function destroy(DanhGiaSanPham $danhGiaSanPham)
    {
        try {
            $danhGiaSanPham->delete();

            return back()->with('success', 'Đánh giá của bạn đã được xóa thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa đánh giá. Vui lòng thử lại.');
        }
    }
}