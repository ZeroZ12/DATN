<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongThucThanhToan extends Model
{
    use HasFactory;
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'phuong_thuc_thanh_toans';
    protected $fillable = ['ten', 'mo_ta', 'hoat_dong'];


}
