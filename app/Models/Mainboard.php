<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mainboard extends Model
{
    protected $table = 'mainboard';
    protected $fillable = ['ten', 'mo_ta'];
}