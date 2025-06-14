<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnhSanPham;
use App\Models\BienTheSanPham;
use App\Models\Chip;
use App\Models\DanhMuc;
use App\Models\Gpu;
use App\Models\Mainboard;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use App\Models\ChiTietDonHang; // Import model ChiTietDonHang
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Traits\HandlesProductImages;

class SanPhamController extends Controller
{
    use HandlesProductImages;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanphams = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.sanpham.index', compact('sanphams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhmucs = DanhMuc::all();
        $thuonghieus = ThuongHieu::all();
        $chips = Chip::all();
        $mainboards = Mainboard::all();
        $gpus = Gpu::all();
        $rams = Ram::all();
        $o_cungs = OCung::all();

        return view('admin.sanpham.create', compact(
            'danhmucs',
            'thuonghieus',
            'chips',
            'mainboards',
            'gpus',
            'rams',
            'o_cungs'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            // Generate unique product code
            $data['ma_san_pham'] = $this->generateUniqueProductCode();
            $data['hoat_dong'] = $request->has('hoat_dong') ? true : false;

            // Handle main product image
            if ($request->hasFile('anh_dai_dien')) {
                $data['anh_dai_dien'] = $this->uploadImage($request->file('anh_dai_dien'), 'images');
            } else {
                $data['anh_dai_dien'] = null;
            }

            //hoat dong

            $sanPham = SanPham::create($data);

            // Handle auxiliary images (new creation)
            $this->handleAuxiliaryImages($sanPham, $request, []);

            // Handle product variants (new creation)
            $this->createProductVariants($sanPham, $data['variants'], $request);

            DB::commit();
            return redirect()->route('admin.sanpham.index')
                ->with('success', 'Sản phẩm và các biến thể đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi tạo sản phẩm: ' . $e->getMessage(), [
                'request' => $request->all(),
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo sản phẩm: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sanpham = SanPham::withTrashed()->with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu', 'anhPhu', 'bienTheSanPhams.ram', 'bienTheSanPhams.oCung'])->findOrFail($id);
        return view('admin.sanpham.show', compact('sanpham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanpham = SanPham::withTrashed()->with(['anhPhu', 'bienTheSanPhams'])->findOrFail($id);

        $danhmucs = DanhMuc::all();
        $thuonghieus = ThuongHieu::all();
        $chips = Chip::all();
        $mainboards = Mainboard::all();
        $gpus = Gpu::all();
        $rams = Ram::all();
        $o_cungs = OCung::all();


        return view('admin.sanpham.edit', compact('sanpham', 'danhmucs', 'thuonghieus', 'chips', 'mainboards', 'gpus', 'rams', 'o_cungs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, $id)
    {
        $sanpham = SanPham::withTrashed()->findOrFail($id);
        $data = $request->validated();

        try {
            DB::beginTransaction();

            // Update main product information
            $sanpham->fill($data);
            $sanpham->hoat_dong = $request->has('hoat_dong')? true : false;

            // Handle main product image
            $this->handleMainProductImage($sanpham, $request);
            $sanpham->save();

            // Handle auxiliary images
            $this->handleAuxiliaryImages($sanpham, $request, $data);

            // Handle product variants (update, create new, soft delete old)
            $this->syncProductVariants($sanpham, $data['variants'] ?? [], $request);

            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage(), [
                'request' => $request->all(),
                'sanpham_id' => $id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi cập nhật sản phẩm: ' . $e->getMessage()]);
        }
    }

    /**
     * Generates a unique product code.
     * @return string
     */
    protected function generateUniqueProductCode(): string
    {
        do {
            $randomCode = 'WD' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (SanPham::where('ma_san_pham', $randomCode)->exists());
        return $randomCode;
    }

    /**
     * Generates a unique variant code.
     * @param array $generatedCodes (Optional) Array of codes generated within the current request to prevent duplicates.
     * @return string
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

    /**
     * Creates new product variants.
     *
     * @param SanPham $sanPham
     * @param array $variantsData
     * @param Request $request
     * @return void
     */
    protected function createProductVariants(SanPham $sanPham, array $variantsData, Request $request): void
    {
        $generatedVariantCodes = [];
        foreach ($variantsData as $index => $variantData) {
            $variant = new BienTheSanPham([
                'id_product' => $sanPham->id,
                'id_ram' => $variantData['ram_id'],
                'id_o_cung' => $variantData['o_cung_id'],
                'gia' => $variantData['gia'],
                'gia_so_sanh' => $variantData['gia_so_sanh'] ?? null,
                'ton_kho' => $variantData['ton_kho'],
                'ma_bien_the' => $this->generateUniqueVariantCode($generatedVariantCodes),
            ]);

            $this->handleVariantImage($variant, $request->file("variants.{$index}.anh_dai_dien"));
            $variant->save();
        }
    }

    /**
     * Syncs product variants (updates existing, creates new, soft deletes removed).
     *
     * @param SanPham $sanpham
     * @param array $incomingVariantsData
     * @param Request $request
     * @return void
     */
    protected function syncProductVariants(SanPham $sanpham, array $incomingVariantsData, Request $request): void
    {
        $existingVariants = $sanpham->bienTheSanPhams->keyBy('id');
        $incomingVariantIds = [];
        $generatedNewVariantCodes = [];

        foreach ($incomingVariantsData as $index => $variantData) {
            $variantImageFile = $request->file("variants.{$index}.anh_dai_dien");

            if (isset($variantData['id']) && $existingVariants->has($variantData['id'])) {
                // Update existing variant
                $variant = $existingVariants->pull($variantData['id']);
                $variant->fill([
                    'id_ram' => $variantData['ram_id'],
                    'id_o_cung' => $variantData['o_cung_id'],
                    'gia' => $variantData['gia'],
                    'gia_so_sanh' => $variantData['gia_so_sanh'] ?? null,
                    'ton_kho' => $variantData['ton_kho'],
                ]);
                $this->handleVariantImage($variant, $variantImageFile);
                $variant->save();
                $incomingVariantIds[] = $variant->id;
            } else {
                // Create new variant
                $newVariant = new BienTheSanPham([
                    'id_product' => $sanpham->id,
                    'id_ram' => $variantData['ram_id'],
                    'id_o_cung' => $variantData['o_cung_id'],
                    'gia' => $variantData['gia'],
                    'gia_so_sanh' => $variantData['gia_so_sanh'] ?? null,
                    'ton_kho' => $variantData['ton_kho'],
                    'ma_bien_the' => $this->generateUniqueVariantCode($generatedNewVariantCodes),
                ]);
                $this->handleVariantImage($newVariant, $variantImageFile);
                $newVariant->save();
                $incomingVariantIds[] = $newVariant->id;
            }
        }

        // Soft delete variants that were removed from the form
        foreach ($existingVariants as $variantToDelete) {
            $this->deleteImage($variantToDelete->anh_dai_dien);
            $variantToDelete->delete();
        }

        // Handle explicitly marked variants for deletion (from 'xoa_bien_the' array)
        if (isset($request->validated()['xoa_bien_the']) && is_array($request->validated()['xoa_bien_the'])) {
            foreach ($request->validated()['xoa_bien_the'] as $variantIdToDelete) {
                if (!in_array($variantIdToDelete, $incomingVariantIds)) {
                    $variantToDelete = BienTheSanPham::find($variantIdToDelete);
                    if ($variantToDelete) {
                        $this->deleteImage($variantToDelete->anh_dai_dien);
                        $variantToDelete->delete();
                    }
                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $sanpham = SanPham::findOrFail($id);
            $sanpham->delete();
            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được xóa mềm thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa mềm sản phẩm: ' . $e->getMessage(), [
                'sanpham_id' => $id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi xóa mềm sản phẩm: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage PERMANENTLY.
     * Before deleting, check if any associated variants are referenced by order details.
     */
    public function forceDelete(string $id)
    {
        try {
            DB::beginTransaction();
            $sanpham = SanPham::withTrashed()->findOrFail($id);

            // --- LOGIC MỚI: Kiểm tra tham chiếu của biến thể trong chi_tiet_don_hangs ---
            // Lấy tất cả các biến thể của sản phẩm này, bao gồm cả các biến thể đã xóa mềm
            $relatedVariants = BienTheSanPham::withTrashed()->where('id_product', $sanpham->id)->get();

            foreach ($relatedVariants as $variant) {
                // Kiểm tra xem biến thể này có được tham chiếu bởi bất kỳ chi tiết đơn hàng nào không
                if (ChiTietDonHang::where('id_bien_the', $variant->id)->exists()) {
                    DB::rollBack();
                    return redirect()->back()->withErrors([
                        'error' => 'Không thể xóa vĩnh viễn sản phẩm này vì một hoặc nhiều biến thể của nó đã được sử dụng trong các đơn hàng đã tồn tại. Vui lòng chỉ xóa mềm sản phẩm.'
                    ]);
                }
            }
            // --- KẾT THÚC LOGIC MỚI ---

            // Delete main product image
            $this->deleteImage($sanpham->anh_dai_dien);

            // Delete auxiliary images
            $anhSanPhams = AnhSanPham::where('id_product', $id)->get();
            foreach ($anhSanPhams as $anh) {
                $this->deleteImage($anh->duong_dan);
                $anh->forceDelete();
            }

            // Delete product variants and their images
            // Logic này chỉ chạy nếu không có biến thể nào được tham chiếu bởi đơn hàng
            foreach ($relatedVariants as $bienThe) {
                $this->deleteImage($bienThe->anh_dai_dien);
                $bienThe->forceDelete();
            }

            // Finally, force delete the product
            $sanpham->forceDelete();

            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa vĩnh viễn sản phẩm: ' . $e->getMessage(), [
                'sanpham_id' => $id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi xóa vĩnh viễn sản phẩm: ' . $e->getMessage()]);
        }
    }

    public function trash()
    {
        $sanphams = SanPham::onlyTrashed()
            ->with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.sanpham.trash', compact('sanphams'));
    }

    /**
     * Restore the specified resource.
     */
    public function restore(string $id)
    {
        try {
            DB::beginTransaction();
            $sanpham = SanPham::onlyTrashed()->findOrFail($id);
            $sanpham->restore();

            // Restore related product variants if they were also soft-deleted
            BienTheSanPham::onlyTrashed()->where('id_product', $sanpham->id)->restore();

            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được khôi phục thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi khôi phục sản phẩm: ' . $e->getMessage(), [
                'sanpham_id' => $id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi khôi phục sản phẩm: ' . $e->getMessage()]);
        }
    }
}
