<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_mucs';
    protected $fillable = ['ten'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_category');   
    }
}



