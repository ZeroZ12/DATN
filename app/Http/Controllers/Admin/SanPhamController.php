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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $sanphams = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])
        ->whereNull('deleted_at') // Hoặc không dùng withTrashed() nếu không cần
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

        $validatedData['hoat_dong'] = $request->has('hoat_dong') ? true : false;

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

    public function update(Request $request, $id)
    {
        // 1. Validation dữ liệu đầu vào
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'nullable|string|max:255|unique:san_phams,ma_san_pham,' . $id,
            'mo_ta' => 'nullable|string',
            'id_category' => 'required|exists:danh_mucs,id',
            'id_brand' => 'required|exists:thuong_hieus,id',
            'id_chip' => 'nullable|exists:chips,id',
            'id_mainboard' => 'nullable|exists:mainboards,id',
            'id_gpu' => 'nullable|exists:gpus,id',
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'anh_phu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Quy tắc cho từng ảnh phụ
            'xoa_anh_phu' => 'nullable|array', // Mảng các ID ảnh phụ cần xóa
            'xoa_anh_phu.*' => 'exists:anh_phu_san_phams,id',

            // Validation cho các biến thể
            'variants' => 'array', // Đảm bảo variants là một mảng
            'variants.*.id' => 'nullable|exists:bien_the_san_phams,id', // ID biến thể hiện có (nếu có)
            'variants.*.ram_id' => 'required|exists:rams,id', // Đảm bảo RAM ID được gửi
            'variants.*.o_cung_id' => 'required|exists:o_cungs,id', // Đảm bảo Ổ cứng ID được gửi
            // 'variants.*.id_color' => 'nullable|exists:colors,id', // Nếu bạn có trường màu sắc
            'variants.*.gia' => 'required|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0',
            'variants.*.ton_kho' => 'required|integer|min:0',
            'variants.*.anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ảnh cho từng biến thể
            'xoa_bien_the' => 'nullable|array', // Mảng các ID biến thể cần xóa
            'xoa_bien_the.*' => 'exists:bien_the_san_phams,id',
        ], [
            // Custom error messages for better user experience
            'ten.required' => 'Tên sản phẩm là bắt buộc.',
            'id_category.required' => 'Vui lòng chọn danh mục.',
            'id_brand.required' => 'Vui lòng chọn thương hiệu.',
            'variants.*.ram_id.required' => 'Biến thể phải có RAM.',
            'variants.*.o_cung_id.required' => 'Biến thể phải có Ổ cứng.',
            'variants.*.gia.required' => 'Giá biến thể là bắt buộc.',
            'variants.*.ton_kho.required' => 'Tồn kho biến thể là bắt buộc.',
            // ... thêm các thông báo lỗi khác nếu cần
        ]);

        $sanpham = SanPham::findOrFail($id);

        try {
            DB::beginTransaction();

            // 2. Cập nhật thông tin chính của sản phẩm
            $sanpham->ten = $validatedData['ten'];
            $sanpham->ma_san_pham = $validatedData['ma_san_pham'];
            $sanpham->mo_ta = $validatedData['mo_ta'];
            $sanpham->id_category = $validatedData['id_category'];
            $sanpham->id_brand = $validatedData['id_brand'];
            $sanpham->id_chip = $validatedData['id_chip'];
            $sanpham->id_mainboard = $validatedData['id_mainboard'];
            $sanpham->id_gpu = $validatedData['id_gpu'];
            $sanpham->bao_hanh_thang = $validatedData['bao_hanh_thang'];
            // Checkbox 'hoat_dong' có thể không được gửi nếu không chọn
            $sanpham->hoat_dong = $request->has('hoat_dong') ? true : false;
            $sanpham->save();

            // 3. Xử lý ảnh đại diện
            if ($request->hasFile('anh_dai_dien')) {
                // Xóa ảnh cũ nếu có
                if ($sanpham->anh_dai_dien && Storage::disk('public')->exists($sanpham->anh_dai_dien)) {
                    Storage::disk('public')->delete($sanpham->anh_dai_dien);
                }
                $path = $request->file('anh_dai_dien')->store('uploads/sanpham', 'public');
                $sanpham->anh_dai_dien = $path;
                $sanpham->save(); // Lưu lại để cập nhật đường dẫn ảnh
            }

            // 4. Xử lý ảnh phụ
            // Xóa ảnh phụ được đánh dấu
            if (isset($validatedData['xoa_anh_phu']) && is_array($validatedData['xoa_anh_phu'])) {
                foreach ($validatedData['xoa_anh_phu'] as $anh_phu_id) {
                    $anhPhu = AnhSanPham::find($anh_phu_id);
                    if ($anhPhu) {
                        if (Storage::disk('public')->exists($anhPhu->duong_dan)) {
                            Storage::disk('public')->delete($anhPhu->duong_dan);
                        }
                        $anhPhu->delete();
                    }
                }
            }

            // Thêm ảnh phụ mới
            if ($request->hasFile('anh_phu')) {
                foreach ($request->file('anh_phu') as $file) {
                    $path = $file->store('uploads/sanpham/anh_phu', 'public');
                    AnhSanPham::create([
                        'id_san_pham' => $sanpham->id,
                        'duong_dan' => $path,
                    ]);
                }
            }

            // 5. Xử lý các biến thể sản phẩm
            // Lưu trữ ID của các biến thể hiện có để dễ dàng tìm kiếm và cập nhật
            $existingVariantMaps = $sanpham->bienTheSanPhams->keyBy('id');
            $updatedVariantIds = []; // Để theo dõi các biến thể đã được xử lý (cập nhật/tạo mới)

            if (isset($validatedData['variants']) && is_array($validatedData['variants'])) {
                foreach ($validatedData['variants'] as $index => $variantData) {
                    // Lấy file ảnh đại diện cho biến thể từ request dựa trên chỉ mục
                    $variantImageFile = $request->file("variants.{$index}.anh_dai_dien");

                    // Nếu biến thể có ID, đây là biến thể hiện có cần cập nhật
                    if (isset($variantData['id']) && $variantData['id']) {
                        $variant = $existingVariantMaps->get($variantData['id']);
                        if ($variant) {
                            $variant->gia = $variantData['gia'];
                            $variant->gia_so_sanh = $variantData['gia_so_sanh'] ?? null;
                            $variant->ton_kho = $variantData['ton_kho'];

                            // Xử lý ảnh đại diện cho biến thể
                            if ($variantImageFile) {
                                // Xóa ảnh cũ nếu có
                                if ($variant->anh_dai_dien && Storage::disk('public')->exists($variant->anh_dai_dien)) {
                                    Storage::disk('public')->delete($variant->anh_dai_dien);
                                }
                                $path = $variantImageFile->store('uploads/bien_the_san_pham', 'public');
                                $variant->anh_dai_dien = $path;
                            }
                            $variant->save();
                            $updatedVariantIds[] = $variant->id;
                        }
                    } else {
                        // Đây là biến thể mới được tạo
                        $newVariant = new BienTheSanPham([
                            'id_product' => $sanpham->id,
                            'id_ram' => $variantData['ram_id'],
                            'id_o_cung' => $variantData['o_cung_id'],
                            'gia' => $variantData['gia'],
                            'gia_so_sanh' => $variantData['gia_so_sanh'] ?? null,
                            'ton_kho' => $variantData['ton_kho'],
                            'ma_bien_the' => 'BT' . Str::upper(Str::random(4)), // Tạo mã biến thể tự động
                        ]);

                        // Xử lý ảnh đại diện cho biến thể mới
                        if ($variantImageFile) {
                            $path = $variantImageFile->store('uploads/bien_the_san_pham', 'public');
                            $newVariant->anh_dai_dien = $path;
                        }
                        $newVariant->save();
                        $updatedVariantIds[] = $newVariant->id;
                    }
                }
            }

            // Soft delete các biến thể không có trong request (nhưng không bị đánh dấu xóa rõ ràng)
            // Hoặc chỉ dựa vào mảng 'xoa_bien_the' nếu bạn muốn kiểm soát tường minh hơn
            if (isset($validatedData['xoa_bien_the']) && is_array($validatedData['xoa_bien_the'])) {
                foreach ($validatedData['xoa_bien_the'] as $variantIdToDelete) {
                    $variantToDelete = BienTheSanPham::find($variantIdToDelete);
                    if ($variantToDelete) {
                        // Xóa ảnh đại diện của biến thể nếu có trước khi soft delete
                        if ($variantToDelete->anh_dai_dien && Storage::disk('public')->exists($variantToDelete->anh_dai_dien)) {
                            Storage::disk('public')->delete($variantToDelete->anh_dai_dien);
                        }
                        $variantToDelete->delete(); // Thực hiện soft delete
                    }
                }
            }


            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('message', 'Sản phẩm đã được cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log lỗi để debug
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage(), [
                'request' => $request->all(),
                'sanpham_id' => $id,
            ]);

            // Trả về với lỗi và giữ lại input cũ
            return redirect()->back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi cập nhật sản phẩm: ' . $e->getMessage()]);
        }
    }

    // ... các phương thức destroy khác ...

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
        $sanpham = SanPham::onlyTrashed()->findOrFail($id);
        $sanpham->restore();

        // Gợi ý: Khôi phục các biến thể sản phẩm liên quan nếu chúng cũng bị xóa mềm
        // Đảm bảo Model BienTheSanPham có SoftDeletes trait
        BienTheSanPham::onlyTrashed()->where('id_product', $sanpham->id)->restore();


        return redirect()->route('admin.sanpham.index')->with('message', 'Sản phẩm đã được khôi phục thành công.');
    }
}
