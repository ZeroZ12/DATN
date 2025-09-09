<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaGiamGiaUser extends Model
{
    use HasFactory;
    protected $table = 'ma_giam_gia_users';
    protected $fillable = 
    [
        'ma_giam_gia_id','user_id','so_lan_su_dung','created_at','updated_at',
    ];
}
