<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
      public function index()
    {
        $sanphams = SanPham::with(['danhMuc', 'thuongHieu', 'chip', 'mainboard', 'gpu'])->orderBy('id', 'desc')->paginate(10);
         return view('client.home', compact('sanphams'));
    }
}
