<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuKienSanPham extends Model
{
    protected $table = 'su_kien_san_phams';

    protected $fillable = [
        'id_su_kien',
        'id_san_pham',
        'id_bien_the_san_pham',
        'gia_su_kien',
        'gia_goc',
        'gia_goc_khi_bat_dau',
        'so_luong_gioi_han', 
        'hien_thi', 
        // 'so_luong', // Optional quantity limit
    ];

    public function suKien()
    {
        return $this->belongsTo(SuKien::class, 'id_su_kien');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_san_pham');
    }

    public function bienTheSanPham()
    {
        return $this->belongsTo(BienTheSanPham::class, 'id_bien_the_san_pham');
    }
}

