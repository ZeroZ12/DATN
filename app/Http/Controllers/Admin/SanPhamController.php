<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnhSanPham;
use App\Models\Chip;
use App\Models\DanhMuc;
use App\Models\Gpu;
use App\Models\Mainboard;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.sanpham.create', compact('danhmucs', 'thuonghieus', 'chips', 'mainboards', 'gpus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {

    //     // Validate dữ liệu
    //     $validatedData = $request->validate([
    //         'ten' => 'required|string|max:255',
    //         'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham',
    //         'mo_ta' => 'nullable|string',
    //         'id_chip' => 'required|exists:chips,id', // Bắt buộc và phải tồn tại trong bảng chips
    //         'id_mainboard' => 'required|exists:mainboards,id', // Bắt buộc và phải tồn tại trong bảng mainboards
    //         'id_gpu' => 'required|exists:gpus,id', // Bắt buộc và phải tồn tại trong bảng gpus
    //         'id_category' => 'required|exists:danh_mucs,id', // Bắt buộc và phải tồn tại trong bảng danh_mucs
    //         'id_brand' => 'required|exists:thuong_hieus,id', // Bắt buộc và phải tồn tại trong bảng thuong_hieus
    //         'bao_hanh_thang' => 'nullable|integer|min:0',
    //         'anh_dai_dien' => 'nullable|image|max:2048', // ảnh tối đa 2MB
    //     ]);

    //     // Xử lý ảnh nếu có
    //     if ($request->hasFile('anh_dai_dien')) {
    //         $path_image = $request->file('anh_dai_dien')->store('images', 'public');
    //         $validatedData['anh_dai_dien'] = $path_image;
    //     }


    //     // Tạo mới sản phẩm
    //     SanPham::create($validatedData);

    //     return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    // }

    /**
     * Display the specified resource.
     */
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
    $sanpham = SanPham::with('anhPhu')->findOrFail($id);

    $danhmucs = DanhMuc::all();
    $thuonghieus = ThuongHieu::all();
    $chips = Chip::all();
    $mainboards = Mainboard::all();
    $gpus = Gpu::all();

    return view('admin.sanpham.edit', compact('sanpham', 'danhmucs', 'thuonghieus', 'chips', 'mainboards', 'gpus'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $sanPham = SanPham::findOrFail($id);

        // Validate dữ liệu
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham,' . $sanPham->id, // Đảm bảo không trùng mã sản phẩm
            'mo_ta' => 'nullable|string',
            'id_chip' => 'required|exists:chips,id', // Bắt buộc và phải tồn tại trong bảng chips
            'id_mainboard' => 'required|exists:mainboards,id', // Bắt buộc và phải tồn tại trong bảng mainboards
            'id_gpu' => 'required|exists:gpus,id', // Bắt buộc và phải tồn tại trong bảng gpus
            'id_category' => 'required|exists:danh_mucs,id', // Bắt buộc và phải tồn tại trong bảng danh_mucs
            'id_brand' => 'required|exists:thuong_hieus,id', // Bắt buộc và phải tồn tại trong bảng thuong_hieus
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|max:2048', // ảnh tối đa 2MB
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
            // Giữ ảnh cũ nếu không có ảnh mới
            $data['anh_dai_dien'] = $sanPham->anh_dai_dien;
        }

        // Cập nhật sản phẩm
        $sanPham->update($data);

        if ($request->has('xoa_anh_phu')) {
            $anhXoaIds = $request->input('xoa_anh_phu');
            $anhXoaList = AnhSanPham::whereIn('id', $anhXoaIds)->get();
            foreach ($anhXoaList as $anh) {
                if (Storage::disk('public')->exists($anh->duong_dan)) {
                    Storage::disk('public')->delete($anh->duong_dan);
                }
                $anh->delete();
            }
        }

        // 2. Thêm ảnh phụ mới
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $file->store('images/anh_phu', 'public');
                AnhSanPham::create([
                    'id_product' => $sanPham->id,
                    'duong_dan' => $path,
                ]);
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
        if ($sanpham->anh_dai_dien && Storage::disk('public')->exists($sanpham->anh_dai_dien)) {
            Storage::disk('public')->delete($sanpham->anh_dai_dien);
        }
        $sanpham->delete();

        return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function store(Request $request)
    {
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
            'anh_phu.*' => 'nullable|image|max:2048', // validate nhiều ảnh phụ
        ]);

        // Lưu ảnh đại diện
        if ($request->hasFile('anh_dai_dien')) {
            $path_image = $request->file('anh_dai_dien')->store('images', 'public');
            $validatedData['anh_dai_dien'] = $path_image;
        }

        // Tạo sản phẩm
        $sanPham = SanPham::create($validatedData);

        // Lưu ảnh phụ
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $file) {
                $path = $file->store('images/anh_phu', 'public');
                AnhSanPham::create([
                    'id_product' => $sanPham->id,
                    'duong_dan' => $path
                ]);
            }
        }

        return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }
}
