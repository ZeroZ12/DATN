<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'rams';
    protected $fillable = ['dung_luong', 'mo_ta'];

    // Quan hệ với bảng Biến Thể Sản Phẩm
    public function bienTheSanPhams()
    {
        return $this->hasMany(BienTheSanPham::class, 'id_ram');
    }
    
}
