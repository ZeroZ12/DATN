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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy TẤT CẢ các sản phẩm, bao gồm cả những sản phẩm đã bị xóa mềm
        // để có thể hiển thị trong view và cung cấp các nút Khôi phục/Xóa vĩnh viễn
        $sanphams = SanPham::withTrashed()->with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])
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
    public function store(Request $request)
    {
        // Tạo mã sản phẩm: WD + 4 số, không trùng DB
        do {
            $randomCode = 'WD' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (SanPham::where('ma_san_pham', $randomCode)->exists());
        $request->merge(['ma_san_pham' => $randomCode]);

        // Validate dữ liệu (bỏ ma_bien_the vì sinh tự động)
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham',
            'mo_ta' => 'nullable|string',
            'id_chip' => 'required|exists:chips,id',
            'id_mainboard' => 'required|exists:mainboards,id',
            'id_gpu' => 'required|exists:gpus,id',
            'id_category' => 'required|exists:danh_mucs,id',
            'id_brand' => 'required|exists:thuong_hieus,id',
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|max:2048',
            'anh_phu.*' => 'nullable|image|max:2048',
            'variants' => 'required|array',
            'variants.*.ram_id' => 'required|exists:rams,id',
            'variants.*.o_cung_id' => 'required|exists:o_cungs,id',
            'variants.*.gia' => 'required|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0',
            'variants.*.ton_kho' => 'required|integer|min:0',
            'variants.*.anh_dai_dien' => 'nullable|image|max:2048'
        ]);

        // Lưu ảnh đại diện chính nếu có
        if ($request->hasFile('anh_dai_dien')) {
            $path_image = $request->file('anh_dai_dien')->store('images', 'public');
            $validatedData['anh_dai_dien'] = $path_image;
        }

        // Tạo sản phẩm
        $sanPham = SanPham::create($validatedData);

        // Lưu ảnh phụ nếu có
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $file->store('images/anh_phu', 'public');
                AnhSanPham::create([
                    'id_product' => $sanPham->id,
                    'duong_dan' => $path
                ]);
            }
        }

        // Tạo biến thể: BT + 4 số, không trùng trong request và DB
        $generatedCodes = [];

        foreach ($request->variants as $index => $variant) {
            // Sinh mã biến thể không trùng
            do {
                $maBienThe = 'BT' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (
                in_array($maBienThe, $generatedCodes) ||
                BienTheSanPham::where('ma_bien_the', $maBienThe)->exists()
            );
            $generatedCodes[] = $maBienThe;

            $variantData = [
                'id_product' => $sanPham->id,
                'id_ram' => $variant['ram_id'],
                'id_o_cung' => $variant['o_cung_id'],
                'gia' => $variant['gia'],
                'gia_so_sanh' => $variant['gia_so_sanh'] ?? null,
                'ton_kho' => $variant['ton_kho'],
                'ma_bien_the' => $maBienThe,
            ];

            // Ảnh riêng của biến thể nếu có
            if ($request->hasFile("variants.$index.anh_dai_dien")) {
                $variantImage = $request->file("variants.$index.anh_dai_dien")
                    ->store("images/bien_the", 'public');
                $variantData['anh_dai_dien'] = $variantImage;
            }

            BienTheSanPham::create($variantData);
        }

        return redirect()->route('admin.sanpham.index')
            ->with('success', 'Sản phẩm và các biến thể đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Khi show, bạn có thể muốn xem cả sản phẩm đã xóa mềm
        $sanpham = SanPham::withTrashed()->with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu', 'anhPhu'])->findOrFail($id);
        return view('admin.sanpham.show', compact('sanpham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Khi edit, bạn có thể muốn chỉnh sửa cả sản phẩm đã xóa mềm
        $sanpham = SanPham::withTrashed()->with('anhPhu')->findOrFail($id);

        $danhmucs = DanhMuc::all();
        $thuonghieus = ThuongHieu::all();
        $chips = Chip::all();
        $mainboards = Mainboard::all();
        $gpus = Gpu::all();
        // Cần truyền rams và o_cungs nếu form edit cũng có biến thể
        $rams = Ram::all();
        $o_cungs = OCung::all();


        return view('admin.sanpham.edit', compact('sanpham', 'danhmucs', 'thuonghieus', 'chips', 'mainboards', 'gpus', 'rams', 'o_cungs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Khi update, bạn có thể muốn update cả sản phẩm đã xóa mềm
        $sanPham = SanPham::withTrashed()->findOrFail($id);

        // Validate dữ liệu
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham,' . $sanPham->id, // Đảm bảo không trùng mã sản phẩm
            'mo_ta' => 'nullable|string',
            'id_chip' => 'required|exists:chips,id',
            'id_mainboard' => 'required|exists:mainboards,id',
            'id_gpu' => 'required|exists:gpus,id',
            'id_category' => 'required|exists:danh_mucs,id',
            'id_brand' => 'required|exists:thuong_hieus,id',
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|max:2048',
            // Thêm validation cho ảnh phụ và biến thể nếu bạn chỉnh sửa chúng trong form update
            'anh_phu.*' => 'nullable|image|max:2048',
            'variants' => 'nullable|array', // Có thể không có biến thể nào được gửi lên khi cập nhật
            'variants.*.ram_id' => 'required_with:variants|exists:rams,id',
            'variants.*.o_cung_id' => 'required_with:variants|exists:o_cungs,id',
            'variants.*.gia' => 'required_with:variants|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0',
            'variants.*.ton_kho' => 'required_with:variants|integer|min:0',
            'variants.*.anh_dai_dien' => 'nullable|image|max:2048',
            'xoa_bien_the.*' => 'nullable|exists:bien_the_san_phams,id', // ID các biến thể muốn xóa
        ]);

        // Lấy dữ liệu form trừ ảnh đại diện
        $data = $validatedData;

        // Xử lý ảnh đại diện nếu có
        if ($request->hasFile('anh_dai_dien')) {
            // Xóa ảnh cũ nếu có
            if ($sanPham->anh_dai_dien && Storage::disk('public')->exists($sanPham->anh_dai_dien)) {
                Storage::disk('public')->delete($sanPham->anh_dai_dien);
            }
            // Lưu ảnh mới
            $data['anh_dai_dien'] = $request->file('anh_dai_dien')->store('images', 'public');
        } else {
            // Giữ ảnh cũ nếu không có ảnh mới được gửi lên
            $data['anh_dai_dien'] = $sanPham->anh_dai_dien;
        }

        // Cập nhật sản phẩm
        $sanPham->update($data);

        // Xóa ảnh phụ được chọn
        if ($request->has('xoa_anh_phu')) {
            $anhXoaIds = $request->input('xoa_anh_phu');
            $anhXoaList = AnhSanPham::whereIn('id', $anhXoaIds)->get();
            foreach ($anhXoaList as $anh) {
                if (Storage::disk('public')->exists($anh->duong_dan)) {
                    Storage::disk('public')->delete($anh->duong_dan);
                }
                $anh->delete(); // Soft delete ảnh phụ nếu Model AnhSanPham có soft deletes, nếu không thì forceDelete
            }
        }

        // Thêm ảnh phụ mới
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $file->store('images/anh_phu', 'public');
                AnhSanPham::create([
                    'id_product' => $sanPham->id,
                    'duong_dan' => $path
                ]);
            }
        }

        // Xử lý cập nhật/thêm/xóa biến thể
        if ($request->has('variants')) {
            foreach ($request->variants as $index => $variantData) {
                $variantId = $variantData['id'] ?? null; // Lấy ID biến thể nếu có (để cập nhật)

                // Validation lại cho từng biến thể để đảm bảo tính toàn vẹn
                $variantValidator = Validator::make($variantData, [
                    'ram_id' => 'required|exists:rams,id',
                    'o_cung_id' => 'required|exists:o_cungs,id',
                    'gia' => 'required|numeric|min:0',
                    'gia_so_sanh' => 'nullable|numeric|min:0',
                    'ton_kho' => 'required|integer|min:0',
                    'anh_dai_dien' => 'nullable|image|max:2048',
                ]);

                if ($variantValidator->fails()) {
                    // Xử lý lỗi validation cho biến thể (ví dụ: redirect với lỗi)
                    return redirect()->back()->withErrors($variantValidator)->withInput();
                }

                $processedVariantData = $variantValidator->validated();
                $processedVariantData['id_product'] = $sanPham->id;

                // Xử lý ảnh riêng của biến thể
                if ($request->hasFile("variants.$index.anh_dai_dien")) {
                    // Nếu là biến thể đã tồn tại và có ảnh cũ, xóa ảnh cũ
                    if ($variantId && ($existingVariant = BienTheSanPham::find($variantId)) && $existingVariant->anh_dai_dien && Storage::disk('public')->exists($existingVariant->anh_dai_dien)) {
                        Storage::disk('public')->delete($existingVariant->anh_dai_dien);
                    }
                    $variantImage = $request->file("variants.$index.anh_dai_dien")->store("images/bien_the", 'public');
                    $processedVariantData['anh_dai_dien'] = $variantImage;
                } else {
                    // Nếu không có ảnh mới, giữ ảnh cũ (chỉ khi cập nhật biến thể hiện có)
                    if ($variantId && ($existingVariant = BienTheSanPham::find($variantId))) {
                        $processedVariantData['anh_dai_dien'] = $existingVariant->anh_dai_dien;
                    }
                }


                if ($variantId) {
                    // Cập nhật biến thể hiện có
                    BienTheSanPham::find($variantId)->update($processedVariantData);
                } else {
                    // Tạo mới biến thể
                    do {
                        $maBienThe = 'BT' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                    } while (BienTheSanPham::where('ma_bien_the', $maBienThe)->exists());
                    $processedVariantData['ma_bien_the'] = $maBienThe;
                    BienTheSanPham::create($processedVariantData);
                }
            }
        }

        // Xóa các biến thể đã chọn
        if ($request->has('xoa_bien_the')) {
            $bienTheXoaIds = $request->input('xoa_bien_the');
            $bienTheXoaList = BienTheSanPham::whereIn('id', $bienTheXoaIds)->get();
            foreach ($bienTheXoaList as $bienThe) {
                if ($bienThe->anh_dai_dien && Storage::disk('public')->exists($bienThe->anh_dai_dien)) {
                    Storage::disk('public')->delete($bienThe->anh_dai_dien);
                }
                $bienThe->delete(); // Soft delete biến thể
            }
        }

        return redirect()->back()->with('message', 'Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanpham = SanPham::findOrFail($id);
        // Chỉ gọi delete() để thực hiện soft delete
        $sanpham->delete();

        return redirect()->route('admin.sanpham.index')->with('message', 'Sản phẩm đã được xóa mềm thành công.');
    }

    /**
     * Remove the specified resource from storage PERMANENTLY.
     */
    public function forceDelete(string $id)
    {
        $sanpham = SanPham::withTrashed()->findOrFail($id);

        // Xóa vĩnh viễn ảnh đại diện nếu có
        if ($sanpham->anh_dai_dien && Storage::disk('public')->exists($sanpham->anh_dai_dien)) {
            Storage::disk('public')->delete($sanpham->anh_dai_dien);
        }

        // Xóa vĩnh viễn ảnh con liên quan trong bảng anh_san_phams
        $anhSanPhams = AnhSanPham::where('id_product', $id)->get();
        foreach ($anhSanPhams as $anh) {
            if (Storage::disk('public')->exists($anh->duong_dan)) {
                Storage::disk('public')->delete($anh->duong_dan);
            }
            $anh->forceDelete();
        }

        // Xóa vĩnh viễn các biến thể sản phẩm liên quan và ảnh của chúng
        // Bạn cần đảm bảo Model BienTheSanPham cũng có SoftDeletes để dùng onlyTrashed
        // hoặc bạn có thể tìm tất cả biến thể liên quan bất kể trạng thái deleted_at
        $bienTheSanPhams = BienTheSanPham::withTrashed()->where('id_product', $sanpham->id)->get();
        foreach ($bienTheSanPhams as $bienThe) {
            if ($bienThe->anh_dai_dien && Storage::disk('public')->exists($bienThe->anh_dai_dien)) {
                Storage::disk('public')->delete($bienThe->anh_dai_dien);
            }
            $bienThe->forceDelete();
        }

        // Xóa vĩnh viễn sản phẩm
        $sanpham->forceDelete();

        return redirect()->route('admin.sanpham.index')->with('message', 'Sản phẩm đã được xóa vĩnh viễn thành công.');
    }

    /**
     * Restore the specified resource.
     */
    public function restore(string $id)
    {
        $sanpham = SanPham::onlyTrashed()->findOrFail($id);
        $sanpham->restore();

        // Gợi ý: Khôi phục các biến thể sản phẩm liên quan nếu chúng cũng bị xóa mềm
        // Đảm bảo Model BienTheSanPham có SoftDeletes trait
        BienTheSanPham::onlyTrashed()->where('id_product', $sanpham->id)->restore();


        return redirect()->route('admin.sanpham.index')->with('message', 'Sản phẩm đã được khôi phục thành công.');
    }
}