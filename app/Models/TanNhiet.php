<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TanNhiet extends Model
{
    /** @use HasFactory<\Database\Factories\TanNhietFactory> */
    use HasFactory, SoftDeletes;

     protected $table = 'tan_nhiets';
    protected $fillable = ['ten','gia','gia_sale','mo_ta'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_tan_nhiet');
    }
}
