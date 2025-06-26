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
    protected $fillable = ['ma', 'loai', 'gia_tri', 'dieu_kien', 'ngay_bat_dau', 'ngay_ket_thuc', 'hoat_dong'];

    /**
     * Get the orders that use this discount code.
     */
    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'id_ma_giam_gia');
    }
}
