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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanphams = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])->orderBy('id', 'desc')->paginate(10);
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



    public function show(string $id)
    {
        $sanpham = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu', 'anhPhu'])->findOrFail($id);
        return view('admin.sanpham.show', compact('sanpham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanpham = SanPham::with(['anhPhu', 'bienTheSanPhams.ram', 'bienTheSanPhams.oCung'])->findOrFail($id);

        $danhmucs = DanhMuc::all();
        $thuonghieus = ThuongHieu::all();
        $chips = Chip::all();
        $mainboards = Mainboard::all();
        $gpus = Gpu::all();
        $rams = Ram::all();
        $o_cungs = OCung::all();

        return view('admin.sanpham.edit', compact(
            'sanpham',
            'danhmucs',
            'thuonghieus',
            'chips',
            'mainboards',
            'gpus',
            'rams',
            'o_cungs'
        ));
    }


    public function update(Request $request, string $id)
    {
        $sanPham = SanPham::with(['bienTheSanPhams', 'anhPhu'])->findOrFail($id);

        // Validate dữ liệu sản phẩm và biến thể
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham,' . $sanPham->id,
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
            'variants.*.id' => 'nullable|exists:bien_the_san_phams,id',
            'variants.*.ram_id' => 'required|exists:rams,id',
            'variants.*.o_cung_id' => 'required|exists:o_cungs,id',
            'variants.*.gia' => 'required|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0',
            'variants.*.ton_kho' => 'required|integer|min:0',
        ]);

        // Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('anh_dai_dien')) {
            if ($sanPham->anh_dai_dien && Storage::disk('public')->exists($sanPham->anh_dai_dien)) {
                Storage::disk('public')->delete($sanPham->anh_dai_dien);
            }
            $validatedData['anh_dai_dien'] = $request->file('anh_dai_dien')->store('images', 'public');
        }

        $validatedData['hoat_dong'] = $request->has('hoat_dong') ? true : false;


        // Cập nhật sản phẩm (loại bỏ dữ liệu không thuộc cột bảng san_phams)
        $sanPham->update(Arr::except($validatedData, ['variants', 'anh_phu', 'xoa_anh_phu']));

        // Xử lý ảnh phụ: xóa
        if ($request->has('xoa_anh_phu')) {
            $anhXoaIds = $request->input('xoa_anh_phu');
            $anhCanXoa = AnhSanPham::whereIn('id', $anhXoaIds)->get();
            foreach ($anhCanXoa as $anh) {
                if (Storage::disk('public')->exists($anh->duong_dan)) {
                    Storage::disk('public')->delete($anh->duong_dan);
                }
                $anh->delete();
            }
        }

        // Thêm ảnh phụ mới
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $file->store('images', 'public');
                AnhSanPham::create([
                    'id_product' => $sanPham->id,
                    'duong_dan' => $path,
                ]);
            }
        }

        // Xử lý biến thể
        $variantIdsFromForm = [];

        foreach ($validatedData['variants'] as $variantData) {
            // Chỉ cho update các trường cho phép
            $dataToSave = [
                'id_ram' => $variantData['ram_id'],
                'id_o_cung' => $variantData['o_cung_id'],
                'gia' => $variantData['gia'],
                'gia_so_sanh' => $variantData['gia_so_sanh'] ?? null,
                'ton_kho' => $variantData['ton_kho'],
            ];

            if (!empty($variantData['id'])) {
                $variant = $sanPham->bienTheSanPhams->firstWhere('id', $variantData['id']);
                if ($variant) {
                    $variant->update($dataToSave);
                    $variantIdsFromForm[] = $variant->id;
                }
            } else {
                // Tạo mã biến thể ngẫu nhiên kiểu BTxxxxxx
                $dataToSave['ma_bien_the'] = 'BT' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $newVariant = $sanPham->bienTheSanPhams()->create($dataToSave);
                $variantIdsFromForm[] = $newVariant->id;
            }
        }

        // Xóa biến thể không còn trong form
        $variantsToDelete = $sanPham->bienTheSanPhams->whereNotIn('id', $variantIdsFromForm);
        foreach ($variantsToDelete as $variant) {
            $variant->delete();
        }

        return redirect()->route('admin.sanpham.edit', $sanPham->id)
            ->with('message', 'Cập nhật sản phẩm và biến thể thành công!');
    }


    /**
     * Remove the specified resource from storage.
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
    //end


    public function destroy(string $id)
    {
        $sanpham = SanPham::findOrFail($id);

        // Xóa mềm sản phẩm (không xóa ảnh hoặc dữ liệu con)
        $sanpham->delete();

        return redirect()->route('admin.sanpham.index')
            ->with('success', 'Sản phẩm đã được xóa tạm thời.');
    }

    // Hiển thị danh sách sản phẩm đã xóa
    public function trash()
    {
        $trashedSanPhams = SanPham::onlyTrashed()->paginate(10);
        return view('admin.sanpham.trash', compact('trashedSanPhams'));
    }

    // Khôi phục sản phẩm
    public function restore($id)
    {
        $sanpham = SanPham::onlyTrashed()->findOrFail($id);
        $sanpham->restore();

        return redirect()->route('admin.sanpham.index')->with('success', 'Khôi phục sản phẩm thành công.');
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        $sanPham = SanPham::withTrashed()->findOrFail($id);

        // Xóa vĩnh viễn ảnh phụ (bao gồm cả đã bị soft delete)
        $sanPham->anhPhu()->withTrashed()->get()->each->forceDelete();

        // Xóa vĩnh viễn biến thể (nếu có soft delete)
        $sanPham->bienTheSanPhams()->withTrashed()->get()->each->forceDelete();

        // Xóa ảnh đại diện chính (file)
        if ($sanPham->thumbnail && Storage::exists($sanPham->thumbnail)) {
            Storage::delete($sanPham->thumbnail);
        }

        // Xóa ảnh phụ (file)
        foreach ($sanPham->anhPhu()->withTrashed()->get() as $anh) {
            if ($anh->duong_dan && Storage::exists($anh->duong_dan)) {
                Storage::delete($anh->duong_dan);
            }
        }

        // Xóa vĩnh viễn chính sản phẩm
        $sanPham->forceDelete();

        return redirect()->route('admin.sanpham.trash')->with('message', 'Đã xóa vĩnh viễn sản phẩm và ảnh liên quan.');
    }
}
