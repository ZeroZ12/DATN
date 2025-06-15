<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Models\Chip;
use App\Models\Gpu;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index(Request $request)
{
    $sanphams = SanPham::with(['thuongHieu', 'chip', 'mainboard', 'gpu', 'BienTheSanPhams.ram', 'BienTheSanPhams.oCung'])
        ->when($request->filled('id_brand'), fn($q) => $q->where('id_brand', $request->id_brand))
        ->when($request->filled('id_chip'), fn($q) => $q->where('id_chip', $request->id_chip))
        ->when($request->filled('id_gpu'), fn($q) => $q->where('id_gpu', $request->id_gpu))

        // Lọc theo biến thể
        ->when(
            $request->filled('id_ram') || $request->filled('id_o_cung'),
            function ($q) use ($request) {
                $q->whereHas('BienTheSanPhams', function ($sub) use ($request) {
                    if ($request->filled('id_ram')) {
                        $sub->where('id_ram', $request->id_ram);
                    }
                    if ($request->filled('id_o_cung')) {
                        $sub->where('id_o_cung', $request->id_o_cung);
                    }
                });
            }
        )
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    $thuongHieus = ThuongHieu::all();
    $chips = Chip::all();
    $gpus = GPU::all();
    $rams = Ram::all();
    $oCungs = OCung::all();

    return view('client.home', compact('sanphams', 'thuongHieus', 'chips', 'gpus', 'rams', 'oCungs'));
}
public function danhmuc($id, Request $request)
{
    // Lấy sản phẩm theo id danh mục
    $query = SanPham::with(['thuongHieu', 'chip', 'mainboard', 'gpu', 'BienTheSanPhams.ram', 'BienTheSanPhams.oCung'])
        ->where('id_category', $id);

    // Lọc theo thương hiệu
    if ($request->filled('brand')) {
        $query->whereIn('id_brand', $request->brand);
    }

    // Lọc theo giá
    if ($request->filled('price')) {
        $query->whereHas('BienTheSanPhams', function($q) use ($request) {
            $q->where(function($subQ) use ($request) {
                foreach ($request->price as $priceRange) {
                    list($min, $max) = explode('-', $priceRange);
                    $subQ->orWhereBetween('gia', [(int)$min, (int)$max]);
                }
            });
        });
    }

    // Sắp xếp sản phẩm
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $query->whereHas('BienTheSanPhams', function($q) {
                    $q->orderBy('gia', 'asc');
                });
                break;
            case 'price_desc':
                $query->whereHas('BienTheSanPhams', function($q) {
                    $q->orderBy('gia', 'desc');
                });
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                // Có thể thêm logic sắp xếp theo độ phổ biến sau
                break;
        }
    }

    $sanphams = $query->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    // Lấy danh mục hiện tại
    $category = DanhMuc::findOrFail($id);

    // Lấy tất cả danh mục
    $danhmucs = DanhMuc::all();

    $thuongHieus = ThuongHieu::all();
    $chips = Chip::all();
    $gpus = GPU::all();
    $rams = Ram::all();
    $oCungs = OCung::all();

    return view('client.danhmuc', compact('sanphams', 'thuongHieus', 'chips', 'gpus', 'rams', 'oCungs', 'category', 'danhmucs'));
}
public function show($id)
{
    $sanpham = SanPham::with([
        'chip',
        'mainboard',
        'gpu',
        'danhMuc',
        'thuongHieu',
        'bienTheSanPhams',
        'anhPhu',
    ])->findOrFail($id);

    $bienTheSanPhams = $sanpham->bienTheSanPhams;

    $sanphamTuongTu = SanPham::where('id_category', $sanpham->id_category)
        ->where('id', '!=', $sanpham->id)
        ->where('hoat_dong', 1)
        ->latest()
        ->take(10)
        ->get();

    return view('client.chitietsanpham', compact(
        'sanpham',
        'sanphamTuongTu',
        'bienTheSanPhams'
    ));
}



}
