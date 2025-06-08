<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'san_phams';

    protected $fillable = [
        'ten', 'ma_san_pham', 'mo_ta', 'id_chip', 'id_mainboard', 'id_gpu', 
        'id_category', 'id_brand', 'bao_hanh_thang', 'hoat_dong', 'anh_dai_dien'
    ];

    // Quan hệ với bảng Chip
    public function chip()
    {
        return $this->belongsTo(Chip::class, 'id_chip');
    }

    // Quan hệ với bảng Mainboard
    public function mainboard()
    {
        return $this->belongsTo(Mainboard::class, 'id_mainboard');
    }

    // Quan hệ với bảng GPU
    public function gpu()
    {
        return $this->belongsTo(Gpu::class, 'id_gpu');
    }

    // Quan hệ với bảng Danh Mục
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'id_category');
    }

    // Quan hệ với bảng Thương Hiệu
    public function thuongHieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'id_brand');
    }
    // Quan hệ với bảng Biến Thể Sản Phẩm
    public function bienTheSanPham()
    {
        return $this->hasMany(BienTheSanPham::class, 'id_product');    
    }

}
