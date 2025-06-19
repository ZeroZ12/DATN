<?php
// app/Models/GioHang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GioHang extends Model
{
    use HasFactory;

    protected $table = 'gio_hangs';

    protected $fillable = [
        'id_user',
        'loai',
        'id_giam_gia',
        'ghi_chu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

   public function chiTietGioHangs()
{
    return $this->hasMany(ChiTietGioHang::class, 'id_gio_hang');
}

}
