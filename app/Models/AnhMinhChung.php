<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhMinhChung extends Model
{
//  protected $fillable = ['id_don_hang', 'loai', 'duong_dan'];

//     public function donHang()
//     {
//         return $this->belongsTo(DonHang::class, 'id_don_hang');
//     }

    protected $fillable = [
        'id_yeu_cau_hoan_tra',
        'duong_dan',
        'loai',
    ];

    public function yeuCauHoanTra()
    {
        return $this->belongsTo(YeuCauHoanTra::class, 'id_yeu_cau_hoan_tra');
    }
}
