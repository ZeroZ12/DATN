<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateDanhGiaSanPhamRequest;
use App\Models\DanhGiaSanPham;
use Illuminate\Http\Request; // Vẫn cần nếu bạn có các method khác dùng nó
use App\Http\Requests\Client\StoreDanhGiaSanPhamRequest; // Import request mới
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Không cần nữa vì FormRequest đã xử lý validation

class DanhGiaSanPhamController extends Controller
{

    public function store(StoreDanhGiaSanPhamRequest $request)
    {
        // Tất cả validation (bao gồm cả kiểm tra đăng nhập) đã được xử lý bởi StoreDanhGiaSanPhamRequest
        // Nếu authorize() trả về false (chưa đăng nhập), request sẽ bị chặn trước khi vào đây.
        // Nếu validation fails, request cũng sẽ bị chặn.

        // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa (logic này vẫn cần ở đây)
        $existingReview = DanhGiaSanPham::where('id_product', $request->id_product)
                                       ->where('id_user', Auth::id())
                                       ->first();

        if ($existingReview) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        try {
            DanhGiaSanPham::create([
                'id_product' => $request->id_product,
                'id_user' => Auth::id(), // Lấy ID của người dùng đang đăng nhập
                'so_sao' => $request->so_sao,
                'binh_luan' => $request->binh_luan,
                'trang_thai' => 'cho_duyet', // Mặc định là chờ duyệt
            ]);

            return back()->with('success', 'Cảm ơn bạn đã gửi đánh giá. Đánh giá của bạn sẽ được hiển thị sau khi duyệt!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại.');
            // Nếu ở môi trường dev, có thể ghi log lỗi: \Log::error($e->getMessage());
        }
    }

        public function update(UpdateDanhGiaSanPhamRequest $request, DanhGiaSanPham $danhGiaSanPham)
    {
        // Policy hoặc authorization trong FormRequest đã đảm bảo rằng chỉ người dùng sở hữu
        // hoặc admin mới có thể cập nhật đánh giá này.

        // Cập nhật các trường
        try {
            $danhGiaSanPham->so_sao = $request->so_sao;
            $danhGiaSanPham->binh_luan = $request->binh_luan;
            // Không cập nhật 'trang_thai' từ frontend. Admin sẽ duyệt lại.
            // Nếu muốn duyệt lại, bạn có thể đặt lại trang_thai thành 'cho_duyet'
            $danhGiaSanPham->trang_thai = 'cho_duyet'; // Đặt lại trạng thái chờ duyệt sau khi sửa

            $danhGiaSanPham->save();

            return back()->with('success', 'Đánh giá của bạn đã được cập nhật và sẽ được hiển thị sau khi duyệt lại!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật đánh giá. Vui lòng thử lại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhGiaSanPham $danhGiaSanPham)
    {
        // Policy hoặc authorization trong FormRequest đã đảm bảo rằng chỉ người dùng sở hữu
        // hoặc admin mới có thể xóa đánh giá này.

        try {
            $danhGiaSanPham->delete(); // Sử dụng soft delete

            return back()->with('success', 'Đánh giá của bạn đã được xóa thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xóa đánh giá. Vui lòng thử lại.');
        }
    }
}