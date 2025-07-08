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
    /**
 * Trả về tên tiếng Việt của trạng thái yêu cầu hoàn trả.
 */
public static function getTenTrangThai($trangThai)
{
    $danhSach = [
        'cho_phe_duyet' => 'Chờ phê duyệt',
        'da_phe_duyet' => 'Đã phê duyệt',
        'tu_choi' => 'Từ chối',
        'dang_van_chuyen_tra_hang' => 'Đang vận chuyển trả hàng',
        'da_nhan_hang' => 'Đã nhận hàng',
        'da_hoan_tien' => 'Đã hoàn tiền',
    ];

    return $danhSach[$trangThai] ?? $trangThai;
}


    /**
     * Mối quan hệ: Hoàn trả thuộc về một đơn hàng.
     */
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_don_hang');
    }
}
