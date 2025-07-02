<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\AnhSanPham;
use App\Models\BienTheSanPham;
use App\Models\Chip;
use App\Models\DanhMuc;
use App\Models\Gpu;
use App\Models\Mainboard;
use App\Models\Nguon;
use App\Models\Tannhiet;
use App\Models\Cases;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu']);

        if ($request->filled('filter_bienthe')) {
            $query->where('co_bien_the', $request->filter_bienthe);
        }

        $sanphams = $query->orderBy('id', 'desc')->paginate(10);
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
        $nguons = Nguon::all();
        $tannhiets = Tannhiet::all();
        $cases = Cases::all();

        return view('admin.sanpham.create', compact(
            'danhmucs',
            'thuonghieus',
            'chips',
            'mainboards',
            'gpus',
            'rams',
            'o_cungs',
            'nguons',
            'tannhiets',
            'cases'
        ));
    }



    public function show(string $id)
    {
        $sanpham = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu', 'nguon' , 'anhPhu'])->findOrFail($id);
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
        $nguons = Nguon::all();
        $tannhiets = Tannhiet::all();
        $cases = Cases::all();

        return view('admin.sanpham.edit', compact(
            'sanpham',
            'danhmucs',
            'thuonghieus',
            'chips',
            'mainboards',
            'gpus',
            'rams',
            'o_cungs',
            'nguons',
            'tannhiets',
            'cases'
        ));
    }


    public function update(UpdateSanPhamRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $sanPham = SanPham::with(['bienTheSanPhams', 'anhPhu'])->findOrFail($id);
            $validatedData = $request->validated();

            // Cập nhật ảnh đại diện nếu có
            if ($request->hasFile('anh_dai_dien')) {
                try {
                    if ($sanPham->anh_dai_dien && Storage::disk('public')->exists($sanPham->anh_dai_dien)) {
                        Storage::disk('public')->delete($sanPham->anh_dai_dien);
                    }
                    $validatedData['anh_dai_dien'] = $request->file('anh_dai_dien')->store('images', 'public');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['anh_dai_dien' => 'Không thể upload ảnh đại diện: ' . $e->getMessage()]);
                }
            }

            $validatedData['hoat_dong'] = $request->has('hoat_dong') ? true : false;

            // Cập nhật sản phẩm
            $sanPham->update(Arr::except($validatedData, ['variants', 'anh_phu', 'xoa_anh_phu']));

            // Nếu là sản phẩm không có biến thể thì cập nhật giá, giá so sánh, số lượng
            if (empty($validatedData['co_bien_the'])) {
                $sanPham->gia = $validatedData['gia'] ?? $sanPham->gia;
                $sanPham->gia_so_sanh = $validatedData['gia_so_sanh'] ?? null;
                $sanPham->so_luong = $validatedData['so_luong'] ?? $sanPham->so_luong;
                $sanPham->save();
            }

            // Xử lý ảnh phụ: xóa
            if ($request->has('xoa_anh_phu')) {
                $anhXoaIds = $request->input('xoa_anh_phu');
                $anhCanXoa = AnhSanPham::whereIn('id', $anhXoaIds)->get();
                foreach ($anhCanXoa as $anh) {
                    try {
                        if (Storage::disk('public')->exists($anh->duong_dan)) {
                            Storage::disk('public')->delete($anh->duong_dan);
                        }
                        $anh->delete();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['anh_phu' => 'Không thể xóa ảnh phụ: ' . $e->getMessage()]);
                    }
                }
            }

            // Thêm ảnh phụ mới
            if ($request->hasFile('anh_phu')) {
                foreach ($request->file('anh_phu') as $file) {
                    try {
                        $path = $file->store('images', 'public');
                        AnhSanPham::create([
                            'id_product' => $sanPham->id,
                            'duong_dan' => $path,
                        ]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['anh_phu' => 'Không thể upload ảnh phụ: ' . $e->getMessage()]);
                    }
                }
            }

            // Xử lý biến thể
            if (!empty($validatedData['co_bien_the']) && !empty($validatedData['variants'])) {
                $variantIdsFromForm = [];
                foreach ($validatedData['variants'] as $variantData) {
                    try {
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
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['variants' => 'Không thể cập nhật biến thể: ' . $e->getMessage()]);
                    }
                }

                // Xóa biến thể không còn trong form
                $variantsToDelete = $sanPham->bienTheSanPhams->whereNotIn('id', $variantIdsFromForm);
                foreach ($variantsToDelete as $variant) {
                    try {
                        $variant->delete();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->withErrors(['variants' => 'Không thể xóa biến thể: ' . $e->getMessage()]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.sanpham.edit', $sanPham->id)
                ->with('message', 'Cập nhật sản phẩm và biến thể thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */


    public function store(StoreSanPhamRequest $request)
    {
        $validatedData = $request->validated();

        // Sinh mã sản phẩm random
        do {
            $randomCode = 'WD' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (SanPham::where('ma_san_pham', $randomCode)->exists());
        $validatedData['ma_san_pham'] = $randomCode;

        // Lưu ảnh đại diện chính nếu có
        if ($request->hasFile('anh_dai_dien')) {
            $path_image = $request->file('anh_dai_dien')->store('images', 'public');
            $validatedData['anh_dai_dien'] = $path_image;
        }

        $validatedData['hoat_dong'] = $request->has('hoat_dong') ? true : false;

        if ($validatedData['co_bien_the']) {
            // Tạo sản phẩm có biến thể như cũ
            $sanPham = SanPham::create($validatedData);

            // Lưu ảnh phụ nếu có
            if ($request->hasFile('anh_phu')) {
                foreach ($request->file('anh_phu') as $file) {
                    $path = $file->store('images/anh_phu', 'public');
                    \App\Models\AnhSanPham::create([
                        'id_product' => $sanPham->id,
                        'duong_dan' => $path
                    ]);
                }
            }

            // Tạo biến thể
            $generatedCodes = [];
            foreach ($request->variants as $index => $variant) {
                do {
                    $maBienThe = 'BT' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                } while (
                    in_array($maBienThe, $generatedCodes) ||
                    \App\Models\BienTheSanPham::where('ma_bien_the', $maBienThe)->exists()
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

                if ($request->hasFile("variants.$index.anh_dai_dien")) {
                    $variantImage = $request->file("variants.$index.anh_dai_dien")
                        ->store("images/bien_the", 'public');
                    $variantData['anh_dai_dien'] = $variantImage;
                }

                \App\Models\BienTheSanPham::create($variantData);
            }
        } else {
            // Tạo sản phẩm không có biến thể
            unset($validatedData['sku']); // Bỏ trường sku nếu có
            $sanPham = SanPham::create($validatedData);
            // Lưu ảnh phụ nếu có
            if ($request->hasFile('anh_phu')) {
                foreach ($request->file('anh_phu') as $file) {
                    $path = $file->store('images/anh_phu', 'public');
                    \App\Models\AnhSanPham::create([
                        'id_product' => $sanPham->id,
                        'duong_dan' => $path
                    ]);
                }
            }
        }

        return redirect()->route('admin.sanpham.index')
            ->with('success', 'Sản phẩm đã được tạo thành công.');
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
