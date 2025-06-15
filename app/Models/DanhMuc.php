<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class DanhMuc extends Model
<<<<<<< HEAD
{   
    use HasFactory;
=======
{
    use HasFactory, SoftDeletes;
>>>>>>> origin
    protected $table = 'danh_mucs';
    protected $fillable = ['ten'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_category');
    }
}
