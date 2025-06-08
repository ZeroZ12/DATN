<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chip extends Model
{
    protected $table = 'chip';
    protected $fillable = ['ten', 'mo_ta'];
}