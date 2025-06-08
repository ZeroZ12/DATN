<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OCung extends Model
{
    protected $table = 'o_cung';
    protected $fillable = ['loai', 'dung_luong', 'mo_ta'];
}