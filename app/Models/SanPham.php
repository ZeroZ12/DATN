<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'san_phams';

    protected $fillable = [
        'ten',
        'ma_san_pham',
        'mo_ta',
        'id_chip',
        'id_mainboard',
        'id_gpu',
        'id_case',
        'id_tannhiet',
        'id_nguon',
        'id_category',
        'id_brand',
        'bao_hanh_thang',
        'hoat_dong',
        'anh_dai_dien',
        'gia',
        'gia_so_sanh',
        'so_luong',
        'co_bien_the',
        'sku',
        
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

    // Quan hệ với bảng Case
    public function case()
    {
        return $this->belongsTo(Cases::class, 'id_case');
    }

    // Quan hệ với bảng Tản Nhiệt
    public function tanNhiet()
    {
        return $this->belongsTo(TanNhiet::class, 'id_tannhiet');
    }

    // Quan hệ với bảng Nguồn
    public function nguon()
    {
        return $this->belongsTo(Nguon::class, 'id_nguon');
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
    public function bienTheSanPhams()
    {
        return $this->hasMany(BienTheSanPham::class, 'id_product');
    }

    public function anhPhu()
    {
        return $this->hasMany(AnhSanPham::class, 'id_product');
    }

        public function danhGiaSanPhams()
    {
        return $this->hasMany(DanhGiaSanPham::class, 'id_product');
    }

    public function suKien()
    {
        return $this->belongsToMany(SuKien::class, 'su_kien_san_phams', 'id_san_pham', 'id_su_kien')
                    ->withPivot('gia_su_kien', 'gia_goc', 'so_luong_gioi_han', 'hien_thi')
                    ->withTimestamps();
    }

    public function suKienDangHoatDong()
    {
        return $this->suKien()
            ->where('su_kien_san_phams.hien_thi', true)
            ->where('ngay_ket_thuc', '>=', now())
            ->orderBy('ngay_bat_dau', 'desc')
            ->first();
    }

}
