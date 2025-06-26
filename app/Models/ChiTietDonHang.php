<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Nếu bạn muốn chi tiết đơn hàng cũng có thể bị xóa mềm, hãy thêm SoftDeletes trait vào đây
// use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietDonHang extends Model
{
    use HasFactory;
    // Nếu bạn muốn chi tiết đơn hàng cũng có thể bị xóa mềm
    // use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chi_tiet_don_hangs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_don_hang',
        'id_product',
        'id_bien_the',
        'ten_hien_thi',
        'so_luong',
        'don_gia',
        'bao_hanh_thang'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'don_gia' => 'decimal:2', // Đảm bảo don_gia được cast thành decimal với 2 chữ số thập phân
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        // Nếu có SoftDeletes, thêm 'deleted_at' => 'datetime'
        // 'deleted_at' => 'datetime',
    ];

    /**
     * Get the order that owns the order detail.
     */
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_don_hang');
    }

    /**
     * Get the product associated with the order detail.
     */
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    /**
     * Get the product variant associated with the order detail.
     */
    public function bienTheSanPham()
    {
        return $this->belongsTo(BienTheSanPham::class, 'id_bien_the');
    }
}
