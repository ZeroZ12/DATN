<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChiNguoiDung extends Model
{
    use HasFactory;
    protected $table = 'dia_chi_nguoi_dungs';
    protected $fillable = [
        'id_user',
        'ten_nguoi_nhan',
        'so_dien_thoai_nguoi_nhan',
        'dia_chi_day_du',
        'tinh_thanh_pho',
        'quan_huyen',
        'phuong_xa',
        'mac_dinh',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'dia_chi_id');
    }
}
