<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class DonHang extends Model
{
    use HasFactory, SoftDeletes; // Sử dụng SoftDeletes trait

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'don_hangs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ma_don',
        'id_user',
        'id_dia_chi_nguoi_dungs',
        'id_phuong_thuc_thanh_toan',
        'tong_tien',
        'trang_thai', // 'cho_xu_ly', 'dang_giao', 'hoan_thanh', 'huy'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tong_tien' => 'decimal:2', // Đảm bảo tong_tien được cast thành decimal với 2 chữ số thập phân
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime', // Cast deleted_at thành datetime
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the address used for the order.
     */
    public function diaChiNguoiDung()
    {
        return $this->belongsTo(DiaChiNguoiDung::class, 'id_dia_chi_nguoi_dungs');
    }

    /**
     * Get the payment method used for the order.
     */
    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'id_phuong_thuc_thanh_toan');
    }

    /**
     * Get the order details for the order.
     */
    public function chiTietDonHangs()
    {
        // Mỗi đơn hàng có nhiều chi tiết đơn hàng.
        // Có thể cần withTrashed() khi eager load nếu muốn lấy cả các chi tiết đã bị xóa mềm (nếu ChiTietDonHang cũng có soft deletes)
        return $this->hasMany(ChiTietDonHang::class, 'id_don_hang');
    }
}
