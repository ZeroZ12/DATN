<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhuongThucThanhToan extends Model
{
    use HasFactory, SoftDeletes;
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'phuong_thuc_thanh_toans';
    protected $fillable = ['ten', 'mo_ta', 'hoat_dong'];

    /**
     * Get the orders that use this payment method.
     */
    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'id_phuong_thuc_thanh_toan');
    }
}
