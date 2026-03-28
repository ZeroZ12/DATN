<?php

namespace App\Http\Controllers;

use App\Models\BienTheSanPham;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;

class SearcherController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $idRam = $request->input('id_ram');
        $idOCung = $request->input('id_o_cung');

        $query = SanPham::query();

        // Tìm kiếm theo từ khóa
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('ten', 'LIKE', '%' . $keyword . '%') ;
                //   ->orWhere('mo_ta', 'LIKE', '%' . $keyword . '%');
            });
        }

        // Lọc theo RAM (nếu có ID RAM được cung cấp)
        if ($idRam) {
            $query->whereHas('bienTheSanPhams', function ($q) use ($idRam) {
                $q->where('id_ram', $idRam);
            });
        }

        // Lọc theo Ổ cứng (nếu có ID Ổ cứng được cung cấp)
        if ($idOCung) {
            $query->whereHas('bienTheSanPhams', function ($q) use ($idOCung) {
                $q->where('id_o_cung', $idOCung);
            });
        }    
        
        // Eager load các mối quan hệ cho giá và biến thể
        $sanphams = $query->with([
            'bienTheSanPhams' => function ($q) use ($idRam, $idOCung) {
                if ($idRam) {
                    $q->where('id_ram', $idRam);
                }
                if ($idOCung) {
                    $q->where('id_o_cung', $idOCung);
                }
            },
            'bienTheSanPhams.ram', // Tải chi tiết RAM nếu cần
            'bienTheSanPhams.oCung', // Tải chi tiết OCung nếu cần
            'danhGiaSanPhams' // Tải đánh giá để tính điểm trung bình
        ])->paginate(10);

        // Lấy tất cả RAM và Ổ cứng để hiển thị trong dropdown
        $rams = Ram::all();
        $o_cungs = OCung::all();
        $thuongHieus = ThuongHieu::all();

        return view('client.search', compact('keyword', 'sanphams', 'rams', 'o_cungs', 'thuongHieus'))
            ->with('title', 'Kết quả tìm kiếm');
    }

}

