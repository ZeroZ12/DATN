<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Đảm bảo đã import Storage

class BienTheSanPhamController extends Controller
{
    public function index($id)
    {
        // Lấy sản phẩm cha, và tất cả biến thể của nó (bao gồm cả đã xóa mềm)
        $sanpham = SanPham::with(['bienTheSanPhams' => function($query) {
            $query->withTrashed()->with(['ram', 'oCung']); // Lấy cả ram và ocung cho biến thể
        }])->findOrFail($id); // Dùng findOrFail thay vì first() để tự động trả về 404 nếu không tìm thấy

        // Kiểm tra nếu sản phẩm không tồn tại (mặc dù findOrFail đã xử lý phần lớn)
        if (!$sanpham) {
            return redirect()->route('admin.sanpham.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.sanpham.bienthe.index', compact('sanpham'));
    }

    public function create($id)
    {
        $sanpham = SanPham::findOrFail($id);
        $ram = Ram::all();
        $ocung = OCung::all();
        return view('admin.sanpham.bienthe.create', compact('sanpham', 'ram', 'ocung'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_ram' => 'required|exists:rams,id',
            'id_o_cung' => 'required|exists:o_cungs,id',
            'id_product' => 'required|exists:san_phams,id',
            'ma_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,ma_bien_the',
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0',
            'ton_kho' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path_image = null;
        // Xử lý ảnh đại diện nếu có
        if ($request->hasFile('anh_dai_dien')) {
            // Lưu vào thư mục 'images/bienthe' trong disk 'public'
            $path_image = $request->file('anh_dai_dien')->store('images/bienthe', 'public');
        }
        $validatedData['anh_dai_dien'] = $path_image; // Gán đường dẫn vào dữ liệu

        BienTheSanPham::create($validatedData);

        return redirect()->route('admin.bienthe.index', $validatedData['id_product'])
                         ->with('message', 'Biến thể sản phẩm đã được tạo thành công.');
    }

    public function edit($id)
    {
        // Khi chỉnh sửa, có thể muốn chỉnh sửa cả biến thể đã xóa mềm
        $bienthe = BienTheSanPham::withTrashed()->findOrFail($id);
        $ram = Ram::all();
        $ocung = OCung::all();
        return view('admin.sanpham.bienthe.edit', compact('bienthe', 'ram', 'ocung'));
    }

    public function update(Request $request, $id)
    {
        // Khi cập nhật, có thể muốn cập nhật cả biến thể đã xóa mềm
        $bienthe = BienTheSanPham::withTrashed()->findOrFail($id);

        $validatedData = $request->validate([
            'id_ram' => 'required|exists:rams,id',
            'id_o_cung' => 'required|exists:o_cungs,id',
            'id_product' => 'required|exists:san_phams,id',
            'ma_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,ma_bien_the,' . $bienthe->id,
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0',
            'ton_kho' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $current_image_path = $bienthe->anh_dai_dien;

        // Xử lý ảnh đại diện mới nếu có
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu có và khác với ảnh mới được upload (hoặc nếu là ảnh mới hoàn toàn)
            if ($current_image_path && Storage::disk('public')->exists($current_image_path)) {
                Storage::disk('public')->delete($current_image_path);
            }
            // Lưu ảnh mới
            $new_image_path = $request->file('anh_dai_dien')->store('images/bienthe', 'public');
            $validatedData['anh_dai_dien'] = $new_image_path;
        } else {
            // Nếu không có ảnh mới được tải lên và không có yêu cầu xóa ảnh
            // Giữ nguyên ảnh cũ
            $validatedData['anh_dai_dien'] = $current_image_path;
        }

        // Lưu id_product (đảm bảo không bị mất)
        $validatedData['id_product'] = $bienthe->id_product;

        $bienthe->update($validatedData);

        return redirect()->back()->with('message', 'Biến thể sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        $bienthe = BienTheSanPham::findOrFail($id);
        $productId = $bienthe->id_product;

        // CHỈ GỌI delete() để thực hiện soft delete. KHÔNG XÓA FILE ẢNH ở đây.
        $bienthe->delete();

        return redirect()->route('admin.bienthe.index', $productId)
                         ->with('message', 'Biến thể sản phẩm đã được xóa mềm thành công.');
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore($id)
    {
        // Lấy biến thể chỉ đã bị xóa mềm
        $bienthe = BienTheSanPham::onlyTrashed()->findOrFail($id);
        $productId = $bienthe->id_product;

        $bienthe->restore(); // Khôi phục biến thể

        return redirect()->route('admin.bienthe.index', $productId)
                         ->with('message', 'Biến thể sản phẩm đã được khôi phục thành công.');
    }

    /**
     * Remove the specified resource from storage PERMANENTLY.
     */
    public function forceDelete($id)
    {
        // Lấy biến thể đã xóa mềm (bao gồm cả đã xóa mềm)
        $bienthe = BienTheSanPham::withTrashed()->findOrFail($id);
        $productId = $bienthe->id_product;

        // Xóa vĩnh viễn ảnh đại diện nếu có
        if ($bienthe->anh_dai_dien && Storage::disk('public')->exists($bienthe->anh_dai_dien)) {
            Storage::disk('public')->delete($bienthe->anh_dai_dien);
        }

        // Xóa vĩnh viễn bản ghi khỏi cơ sở dữ liệu
        $bienthe->forceDelete();

        return redirect()->route('admin.bienthe.index', $productId)
                         ->with('message', 'Biến thể sản phẩm đã bị xóa vĩnh viễn.');
    }
}