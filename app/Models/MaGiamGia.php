<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaGiamGia extends Model
{
    use HasFactory, SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'ma_giam_gias';
    protected $fillable = ['ma', 'loai', 'so_luong', 'gia_tri', 'gia_tri_toi_da', 'dieu_kien', 'ngay_bat_dau', 'ngay_ket_thuc', 'hoat_dong','gioi_han_moi_user'];

    /**
     * Get the orders that use this discount code.
     */
    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'id_ma_giam_gia');
    }
}

