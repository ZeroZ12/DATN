<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    /** @use HasFactory<\Database\Factories\CasesFactory> */
    use HasFactory;

     protected $table = 'cases';
    protected $fillable = ['ten','gia','gia_sale','mo_ta'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_case');
    }
}
