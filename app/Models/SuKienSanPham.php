<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuKienSanPham extends Model
{
    protected $table = 'su_kien_san_pham';

    protected $fillable = [
        'id_su_kien',
        'id_san_pham',
        'id_bien_the_san_pham',
        'gia_su_kien',
        'gia_goc',
        'quantity_limit', 
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
