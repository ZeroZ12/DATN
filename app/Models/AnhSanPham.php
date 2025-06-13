<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnhSanPham extends Model
{
    use SoftDeletes;
    protected $table = 'anh_san_phams';

    protected $fillable = [
        'id_product',
        'duong_dan',
    ];

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }
}
