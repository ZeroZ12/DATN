<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_gio_hangs';

    protected $fillable = [
        'id_gio_hang',
        'id_product',
        'id_bien_the',
        'so_luong',
        'gia'
    ];

    public function gioHang()
    {
        return $this->belongsTo(GioHang::class, 'id_gio_hang');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    public function bienThe()
    {
        return $this->belongsTo(BienTheSanPham::class, 'id_bien_the');
    }
}
