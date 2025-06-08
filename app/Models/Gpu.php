<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    protected $table = 'gpu';
    protected $fillable = ['ten', 'mo_ta'];
}