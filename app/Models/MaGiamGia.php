<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gia';
    protected $fillable = ['ma', 'loai', 'gia_tri', 'ngay_bat_dau', 'ngay_ket_thuc', 'hoat_dong'];
    protected $casts = [
        'loai' => 'string',
        'gia_tri' => 'decimal:2',
        'ngay_bat_dau' => 'datetime',
        'ngay_ket_thuc' => 'datetime',
        'hoat_dong' => 'boolean',
    ];
}