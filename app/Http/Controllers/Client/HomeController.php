<?php

namespace App\Http\Controllers\Client; // Lưu ý namespace có thể là App\Http\Controllers nếu bạn không dùng Client subfolder

use App\Http\Controllers\Controller;
use App\Models\Chip;
use App\Models\Gpu;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;    // Đảm bảo import Model SanPham
use App\Models\ThuongHieu;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories
        $danhMucs = DanhMuc::all();

        // Get products for each category
        $sanphams = SanPham::with([
                'thuongHieu',
                'chip',
                'mainboard',
                'gpu',
                'BienTheSanPhams.ram',
                'BienTheSanPhams.oCung',
            ])
            // === THAY ĐỔI TẠI ĐÂY: Thêm withAvg để tính trung bình số sao ===
            ->withAvg(['danhGiaSanPhams as average_rating' => function ($query) {
                // Chỉ tính trung bình từ các đánh giá có trạng thái 'da_duyet'
                $query->where('trang_thai', 'da_duyet');
            }], 'so_sao')
            // ===============================================================

            ->when($request->filled('id_brand'), fn($q) => $q->where('id_brand', $request->id_brand))
            ->when($request->filled('id_chip'), fn($q) => $q->where('id_chip', $request->id_chip))
            ->when($request->filled('id_gpu'), fn($q) => $q->where('id_gpu', $request->id_gpu))
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


        return view('client.home', compact('sanphams', 'thuongHieus', 'chips', 'gpus', 'rams', 'oCungs', 'danhMucs'));
    }
}