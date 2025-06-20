<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OCung extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'o_cungs';
    protected $fillable = ['loai', 'dung_luong','mo_ta'];

    // Quan hệ với bảng Biến Thể Sản Phẩm
    public function bienTheSanPhams()
    {
        return $this->hasMany(BienTheSanPham::class, 'id_o_cung');
    }
}
