<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGiaSanPham extends Model
{
    use HasFactory, SoftDeletes; // Nhớ thêm SoftDeletes nếu bạn đã dùng deleted_at

    protected $table = 'danh_gia_san_phams'; // Đảm bảo đúng tên bảng

    protected $fillable = [
        'id_product',
        'id_user',
        'so_sao',
        'binh_luan',
        'trang_thai', // Thêm trường này nếu bạn đã thêm vào migration
    ];

    // Định nghĩa mối quan hệ
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}