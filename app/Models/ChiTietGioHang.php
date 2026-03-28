<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    protected $table = 'chi_tiet_gio_hangs';

    protected $fillable = ['id_gio_hang', 'id_product', 'id_bien_the', 'so_luong', 'gia'];

    protected $appends = ['gia_hien_thi'];

    public function getGiaHienThiAttribute()
    {
        // Nếu có biến thể
        if ($this->bienThe) {
            $suKien = $this->bienThe->sanPham->suKienDangHoatDong();
        } else {
            $suKien = $this->sanPham->suKienDangHoatDong();
        }

        // Nếu đang có sự kiện => dùng giá sự kiện
        if ($suKien) {
            return $suKien->pivot->gia_su_kien;
        }

        // Nếu không có sự kiện => trả về giá gốc
        return $this->gia ?? ($this->bienThe ? $this->bienThe->gia : $this->sanPham->gia);
    }

    public function gioHang()
    {
        return $this->belongsTo(GioHang::class, 'id_gio_hang');
    }

    public function bienTheSanPham()
    {
        return $this->belongsTo(BienTheSanPham::class, 'id_bien_the');
    }

    public function bienThe()
    {
        return $this->belongsTo(BienTheSanPham::class, 'id_bien_the');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_product');
    }

    // public function suKienBienThe()
    // {
    //     return $this->hasOne(SuKienSanPham::class, 'id_bien_the_san_pham', 'id_bien_the');
    // }

    // public function suKienSanPham()
    // {
    //     return $this->hasOne(SuKienSanPham::class, 'id_san_pham', 'id_product')
    //         ->whereNull('id_bien_the_san_pham');
    // }

}

