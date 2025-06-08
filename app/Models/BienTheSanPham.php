<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BienTheSanPham extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'bien_the_san_phams';
    protected $fillable = [
        'id_product', 'id_ram', 'id_o_cung', 'gia', 'gia_so_sanh', 'ton_kho', 'ma_bien_the', 'anh_dai_dien'
    ];

    // Quan hệ với bảng Sản Phẩm
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
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
