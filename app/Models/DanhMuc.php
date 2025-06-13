<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class DanhMuc extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'danh_mucs';
    protected $fillable = ['ten'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_category');
    }
}
