<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'gpus';
    protected $fillable = ['ten', 'mo_ta'];

    // Quan hệ với bảng Sản Phẩm
    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'id_gpu');
    }
}

