<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        // Validate dữ liệu
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham',
            'mo_ta' => 'nullable|string',
            'id_chip' => 'nullable|exists:chips,id',
            'id_mainboard' => 'nullable|exists:mainboards,id',
            'id_gpu' => 'nullable|exists:gpus,id',
            'id_category' => 'required|exists:danh_mucs,id', // Sửa từ ma_danh_muc thành id_category
            'id_brand' => 'required|exists:thuong_hieus,id', // Sửa từ ma_thuong_hieu thành id_brand
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'hoat_dong' => 'boolean',
            'anh_dai_dien' => 'nullable|image|max:2048', // ảnh tối đa 2MB
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('anh_dai_dien')) {
            $path_image = $request->file('anh_dai_dien')->store('images', 'public');
            $validatedData['anh_dai_dien'] = $path_image;
        }

        // Tạo mới sản phẩm
        SanPham::create($validatedData);

        return redirect()->route('admin.sanpham.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sanpham = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])->findOrFail($id);
        return view('admin.sanpham.show', compact('sanpham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sanpham = SanPham::findOrFail($id);
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
            'ma_san_pham' => 'required|string|max:50|unique:san_phams,ma_san_pham,' . $sanPham->id,
            'mo_ta' => 'nullable|string',
            'id_chip' => 'nullable|exists:chips,id',
            'id_mainboard' => 'nullable|exists:mainboards,id',
            'id_gpu' => 'nullable|exists:gpus,id',
            'id_category' => 'required|exists:danh_mucs,id',  // Sửa từ ma_danh_muc thành id_category
            'id_brand' => 'required|exists:thuong_hieus,id',    // Sửa từ ma_thuong_hieu thành id_brand
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'hoat_dong' => 'boolean',
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

        // Nếu checkbox "hoat_dong" bị bỏ chọn thì gán false
        $data['hoat_dong'] = $request->has('hoat_dong') ? $request->boolean('hoat_dong') : false;

        // Cập nhật sản phẩm
        $sanPham->update($data);

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
}
