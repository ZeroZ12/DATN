<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'ma_giam_gias';
    protected $fillable = ['ma', 'loai', 'gia_tri', 'ngay_bat_dau', 'ngay_ket_thuc', 'hoat_dong'];

    // Quan hệ với bảng Giỏ Hàng
}
