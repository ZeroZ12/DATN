<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuKien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'su_kien'; 

    protected $fillable = [
        'ten_su_kien',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        // 'trang_thai', 
    ];

    protected $casts = [
        'ngay_bat_dau' => 'datetime',
        'ngay_ket_thuc' => 'datetime',
        'trang_thai' => 'boolean', // Chuyển đổi trạng thái thành boolean
    ];

    public function sanPhams()
    {
        return $this->belongsToMany(SanPham::class, 'su_kien_san_pham', 'id_su_kien', 'id_san_pham')
                    ->withPivot('gia_su_kien', 'gia_goc', 'quantity_limit', 'hien_thi')
                    ->withTimestamps();
    }

    public function bienTheSanPhams()
    {
        return $this->belongsToMany(BienTheSanPham::class, 'su_kien_san_pham', 'id_su_kien', 'id_bien_the_san_pham')
                    ->withPivot('gia_su_kien', 'gia_goc', 'quantity_limit', 'hien_thi')
                    ->withTimestamps();
    }

    public function ChiTietSuKien()
    {
        return $this->hasMany(SuKienSanPham::class, 'id_su_kien');
    }

    public function isActive()
    {
        return $this->trang_thai && now()->between($this->ngay_bat_dau, $this->ngay_ket_thuc);
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->ngay_bat_dau->format('d-m-Y H:i');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->ngay_ket_thuc->format('d-m-Y H:i');
    }
}