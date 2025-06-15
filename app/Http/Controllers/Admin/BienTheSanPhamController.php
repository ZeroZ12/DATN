<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request; // Still needed for other methods or if you need the base Request object
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\HandlesProductImages;
use App\Http\Requests\StoreBienTheSanPhamRequest; // Import Form Request mới
use App\Http\Requests\UpdateBienTheSanPhamRequest; // Import Form Request mới

class BienTheSanPhamController extends Controller
{
    use HandlesProductImages;

    /**
     * Display a listing of the active resources for a specific product.
     */
    public function index(SanPham $sanpham)
    {
        $bienthes = $sanpham->bienTheSanPhams()->with(['ram', 'oCung'])->paginate(10);

        return view('admin.sanpham.bienthe.index', compact('bienthes', 'sanpham'));
    }

    /**
     * Show the form for creating a new resource for a specific product.
     */
    public function create(SanPham $sanpham)
    {
        $rams = Ram::all();
        $ocungs = OCung::all();
        return view('admin.sanpham.bienthe.create', compact('sanpham', 'rams', 'ocungs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBienTheSanPhamRequest $request Tự động validate request
     * @param SanPham $sanpham Model sản phẩm cha được inject tự động
     */
    public function store(StoreBienTheSanPhamRequest $request, SanPham $sanpham) // <-- Đã thay đổi
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated(); // Dữ liệu đã validate và an toàn

            $validatedData['id_product'] = $sanpham->id; // Gán id sản phẩm cha
            $validatedData['ma_bien_the'] = $this->generateUniqueVariantCode(); // Tạo mã biến thể

            // Xử lý ảnh đại diện bằng trait
            $validatedData['anh_dai_dien'] = $this->uploadImage(
                $request->file('anh_dai_dien'),
                'images/bienthe'
            );

            //hoat dong
            $validatedData['hoat_dong'] = $request->has('hoat_dong') ? true : false;

            BienTheSanPham::create($validatedData);

            DB::commit();
            return redirect()->route('admin.sanpham.bienthe.index', $sanpham->id)
                ->with('success', 'Biến thể sản phẩm đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi tạo biến thể sản phẩm: ' . $e->getMessage(), [
                'request' => $request->all(),
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo biến thể: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SanPham $sanpham, BienTheSanPham $bienthe)
    {
        $rams = Ram::all();
        $ocungs = OCung::all();
        return view('admin.sanpham.bienthe.edit', compact('bienthe', 'rams', 'ocungs', 'sanpham'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBienTheSanPhamRequest $request Tự động validate request
     * @param SanPham $sanpham Model sản phẩm cha được inject tự động
     * @param BienTheSanPham $bienthe Model biến thể được inject tự động
     */
    public function update(UpdateBienTheSanPhamRequest $request, SanPham $sanpham, BienTheSanPham $bienthe) // <-- Đã thay đổi
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated(); // Dữ liệu đã validate và an toàn

            // mã biến thể và id_product không thay đổi khi update từ form này
            $validatedData['ma_bien_the'] = $bienthe->ma_bien_the;
            $validatedData['id_product'] = $sanpham->id;

            $bienthe->fill($validatedData); // Gán dữ liệu đã validate

            // Xử lý ảnh đại diện bằng trait
            $this->handleVariantImage($bienthe, $request->file('anh_dai_dien'));

            $bienthe->hoat_dong = $request->has('hoat_dong') ? true : false;

            $bienthe->save(); // Lưu thay đổi

            DB::commit();
            return redirect()->route('admin.sanpham.bienthe.index', $sanpham->id)
                ->with('success', 'Biến thể sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi cập nhật biến thể sản phẩm: ' . $e->getMessage(), [
                'request' => $request->all(),
                'bienthe_id' => $bienthe->id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi cập nhật biến thể: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(SanPham $sanpham, BienTheSanPham $bienthe)
    {
        try {
            DB::beginTransaction();
            $bienthe->delete();

            DB::commit();
            return redirect()->route('admin.sanpham.bienthe.index', $sanpham->id)
                ->with('success', 'Biến thể sản phẩm đã được xóa mềm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa mềm biến thể sản phẩm: ' . $e->getMessage(), [
                'bienthe_id' => $bienthe->id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi xóa mềm biến thể: ' . $e->getMessage()]);
        }
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(BienTheSanPham $bienthe)
    {
        try {
            DB::beginTransaction();
            // Model Binding đã tự động lấy biến thể đã xóa mềm do ->withTrashed() trong route
            $bienthe->restore();

            DB::commit();
            return redirect()->route('admin.bienthe.trashed')
                ->with('success', 'Biến thể sản phẩm đã được khôi phục thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi khôi phục biến thể sản phẩm: ' . $e->getMessage(), [
                'bienthe_id' => $bienthe->id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi khôi phục biến thể: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage PERMANENTLY.
     */
    public function forceDelete(BienTheSanPham $bienthe)
    {
        try {
            DB::beginTransaction();

            $hasOrderDetails = ChiTietDonHang::where('id_bien_the', $bienthe->id)->exists();

            if ($hasOrderDetails) {
                DB::rollBack();
                return redirect()->back()->withErrors([
                    'error' => 'Không thể xóa vĩnh viễn biến thể này vì nó đã được sử dụng trong các đơn hàng đã tồn tại. Vui lòng chỉ xóa mềm.'
                ]);
            }

            $this->deleteImage($bienthe->anh_dai_dien);
            $bienthe->forceDelete();

            DB::commit();
            return redirect()->route('admin.bienthe.trashed')
                ->with('success', 'Biến thể sản phẩm đã bị xóa vĩnh viễn.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa vĩnh viễn biến thể sản phẩm: ' . $e->getMessage(), [
                'bienthe_id' => $bienthe->id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi xóa vĩnh viễn biến thể: ' . $e->getMessage()]);
        }
    }

    /**
     * Display soft-deleted variants (trash bin).
     */
    public function trashed()
    {
        $bienthes = BienTheSanPham::onlyTrashed()
            ->with(['ram', 'oCung', 'sanPham'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.sanpham.bienthe.trash', compact('bienthes'));
    }

    /**
     * Generates a unique variant code.
     */
    protected function generateUniqueVariantCode(array &$generatedCodes = []): string
    {
        do {
            $maBienThe = 'BT' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (
            in_array($maBienThe, $generatedCodes) ||
            BienTheSanPham::where('ma_bien_the', $maBienThe)->exists()
        );
        $generatedCodes[] = $maBienThe;
        return $maBienThe;
    }
}
