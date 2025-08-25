<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BienTheSanPham extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'bien_the_san_phams';
    protected $fillable = [
        'id_product', 'id_ram', 'id_o_cung', 'gia', 'gia_so_sanh', 'ton_kho', 'ma_bien_the', 'anh_dai_dien', 'hoat_dong'
    ];

    // Quan hệ với bảng Sản Phẩm
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    public function suKien()
    {
        return $this->belongsToMany(SuKien::class, 'su_kien_san_phams', 'id_bien_the_san_pham', 'id_su_kien')
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


    // Quan hệ với bảng RAM
    public function ram()
    {
        return $this->belongsTo(Ram::class, 'id_ram');
    }

    // Quan hệ với bảng Ổ Cứng
    public function oCung()
    {
        return $this->belongsTo(OCung::class, 'id_o_cung');
    }
}
