<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCauHoanTra extends Model
{
    use HasFactory;

    protected $table = 'yeu_cau_hoan_tra';

  protected $fillable = [
    'id_don_hang',
    'ma_hoan_tra',
    'sdt_lien_he',
    'phuong_thuc_hoan_tien',
    'ten_ngan_hang',
    'so_tai_khoan',
    'ten_chu_tai_khoan',
    'ly_do',
    'trang_thai',
    'thoi_gian_tra_hang',
    'thoi_gian_nhan_hang',
    'thoi_gian_hoan_tien',
    'id_nguoi_hoan_tien',
    'trang_thai_vc_hoan_hang'
];


    const PHUONG_THUC_HOAN_TIEN = [
        'momo',
        'bank_transfer',
    ];

    const TRANG_THAI = [
        'cho_phe_duyet',
        'da_phe_duyet',
        'tu_choi',
        'dang_van_chuyen_tra_hang',
        'da_nhan_hang',
        'da_hoan_tien',
    ];
    //trang thai cap nhat
    const TRANG_THAI_FLOW = [
    'cho_phe_duyet' => ['da_phe_duyet', 'tu_choi'],
    'da_phe_duyet' => ['dang_van_chuyen_tra_hang'],
    'dang_van_chuyen_tra_hang' => ['da_nhan_hang'],
    'da_nhan_hang' => ['da_hoan_tien'],
];
    /**
 * Trả về tên tiếng Việt của trạng thái yêu cầu hoàn trả.
 */
public static function getTenTrangThai($trangThai)
{
    $danhSach = [
        'cho_phe_duyet' => 'Chờ phê duyệt',
        'da_phe_duyet' => 'Đã phê duyệt',
        'tu_choi' => 'Từ chối',
        'dang_van_chuyen_tra_hang' => 'Đang trả hàng',
        'da_nhan_hang' => 'Đã nhận hàng',
        'da_hoan_tien' => 'Đã hoàn tiền',
    ];

    return $danhSach[$trangThai] ?? $trangThai;
}

    public static function getTenTrangVcThaiHoan($status)
    {
        return [
            'cho_lay_hang' => 'Chờ khách gửi hàng',
            'dang_giao_hang' => 'Đang trả hàng',
            'giao_thanh_cong'       => 'Đã giao',
            'giao_that_bai' => 'Giao thất bại',
        ][$status] ?? $status;
    }



    /**
     * Mối quan hệ: Hoàn trả thuộc về một đơn hàng.
     */
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_don_hang');
    }
    public function nguoiHoanTien()
{
    return $this->belongsTo(User::class, 'id_nguoi_hoan_tien');
}

public function anhMinhChung()
{
    return $this->hasMany(AnhMinhChung::class, 'id_yeu_cau_hoan_tra');
}

}
