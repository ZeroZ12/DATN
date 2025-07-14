<?php

namespace App\Http\Controllers;

use App\Models\BienTheSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SearcherController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $idBrand = $request->input('id_brand');
        $isChip = $request->input('is_chip');
        $query = SanPham::query();
        if (!empty($keyword)) {
            $query->where('ten_san_pham', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('mo_ta', 'LIKE', '%' . $keyword . '%');
        }
        if($idBrand){
            $query->where('is_thuong_hieu', $idBrand);
        }
        if($isChip){
            $query->where('is_chip', $isChip);
        }
        if($request->has('is_ram') || $request->has('is_o_cung')) {
            $query->whereHas('BienTheSanPham', function($q) use ($request) {
                if($request->has('is_ram')) {
                    $q->where('is_ram', $request->input('is_ram'));
                }
                if($request->has('is_o_cung')) {
                    $q->where('is_o_cung', $request->input('is_o_cung'));
                }
            });
        }
        $searchResults = $query->with('BienTheSanPham','thuongHieu', 'chip', 'ram', 'oCung')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view('client.search', compact('keyword', 'searchResults', 'idBrand', 'isChip'))
            ->with('title', 'Kết quả tìm kiếm');
    }

}
