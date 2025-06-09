<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhSanPham extends Model
{
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
