<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhMinhChung extends Model
{
    const LOAI_NGUOI_DUNG = 'nguoi_dung';
    const LOAI_ADMIN = 'admin';

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
