<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nguon extends Model
{
    /** @use HasFactory<\Database\Factories\NguonFactory> */
    use HasFactory, SoftDeletes;

     protected $table = 'nguons';
    protected $fillable = ['ten','gia','gia_sale','mo_ta'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_nguon');
    }
}
