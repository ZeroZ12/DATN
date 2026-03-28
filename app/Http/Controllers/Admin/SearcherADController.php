<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SearcherADController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $query = SanPham::query();
        // Tìm kiếm theo từ khóa
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('ten', 'LIKE', '%' . $keyword . '%') ;
            });
        }
        $sanphams = $query->paginate(10);

        return view('admin.sanpham.search', compact('keyword', 'sanphams'))
            ->with('title', 'Kết quả tìm kiếm');
    }

}

