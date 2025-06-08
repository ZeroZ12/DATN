<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BienTheSanPhamController extends Controller
{
    public function index($id)
    {
        $sanpham = SanPham::with(['bienTheSanPham.ram','bienTheSanPham.oCung'])->where('id',$id)->first();

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
        $data= $request->validate([
            'id_ram' => 'required|exists:rams,id',
            'id_o_cung' => 'required|exists:o_cungs,id',
            'id_product' => 'required|exists:san_phams,id',
            'ma_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,ma_bien_the',
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0',
            'ton_kho' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        //xu ly hinh anh Storage
        if ($request->hasFile('anh_dai_dien')) {
            $file = $request->file('anh_dai_dien');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path= $file->storeAs('public/images', $filename, 'public');
        }

        //Luu id_san_pham
        $data['anh_dai_dien'] = $path ?? null;

        BienTheSanPham::create($data);
        return redirect()->route('admin.bienthe.index', $data['id_product'])
                         ->with('success', 'Biến thể sản phẩm đã được tạo thành công.');
                    
    }

    public function edit($id)
    {
        $bienthe = BienTheSanPham::findOrFail($id);
        $ram = Ram::all();
        $ocung = OCung::all();
        return view('admin.sanpham.bienthe.edit', compact('bienthe', 'ram', 'ocung'));
    }

    public function update(Request $request, $id)
    {
        $bienthe = BienTheSanPham::findOrFail($id);

        $data = $request->validate([
            'id_ram' => 'required|exists:rams,id',
            'id_o_cung' => 'required|exists:o_cungs,id',
            'id_product' => 'required|exists:san_phams,id',
            'ma_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,ma_bien_the,' . $bienthe->id,
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0',
            'ton_kho' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //xu ly hinh anh Storage
        if ($request->hasFile('anh_dai_dien')) {
            $file = $request->file('anh_dai_dien');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $data['anh_dai_dien'] = $filename;
        }
        else {
            $data['anh_dai_dien'] = $bienthe->anh_dai_dien; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        }

        //Xoa anh cu neu co
        if ($bienthe->anh_dai_dien && $data['anh_dai_dien'] !== $bienthe->anh_dai_dien) {
            Storage::disk('public')->delete('images/' . $bienthe->anh_dai_dien);
        }   



        //Luu id_san_pham
        $data['id_product'] = $bienthe->id_product;

        $bienthe->update($data);
        return redirect()->route('admin.bienthe.index', $bienthe->id_product)
                         ->with('success', 'Biến thể sản phẩm đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $bienthe = BienTheSanPham::findOrFail($id);
        $productId = $bienthe->id_product;

        // Xóa ảnh nếu có
        if ($bienthe->anh_dai_dien) {
            Storage::disk('public')->delete('images/' . $bienthe->anh_dai_dien);
        }

        $bienthe->delete();
        return redirect()->route('admin.bienthe.index', $productId)
                         ->with('success', 'Biến thể sản phẩm đã được xóa thành công.');
    }
}
