<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class DonHang extends Model
{
    use HasFactory, SoftDeletes; // Sử dụng SoftDeletes trait

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'don_hangs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ma_don',
        'id_user',
        'id_dia_chi_nguoi_dungs',
        'id_phuong_thuc_thanh_toan',
        'id_ma_giam_gia',
        'tong_tien',
        'tong_tien_goc',
        'giam_gia',
        'trang_thai',
        'huy_boi',
        'phuong_thuc_hoan_tien',
        'trang_thai_vc_giao_hang',
        'trang_thai_vc_hoan',
        'ten_ngan_hang',
        'so_tai_khoan',
        'thoi_gian_khach_tra',
        'thoi_gian_shop_nhan',
        'ly_do',
        'id_nguoi_hoan_tien',
        'thoi_gian_hoan_tien'
    ];

    const TRANG_THAI = [
        'cho_xac_nhan',
        'cho_thanh_toan',
        'da_xac_nhan',
        'chuan_bi_hang',
        'dang_giao_hang',
        'giao_thanh_cong',
        'giao_that_bai',
        'hoan_thanh',
        'da_huy',
        // Trạng thái hoàn trả
        'yeu_cau_hoan_tra',
        'da_phe_duyet',
        'dang_tra_hang',
        'shop_da_nhan_hang',
        'da_hoan_tien',
        'tu_choi_hoan',
    ];

    const TRANG_THAI_TEXT = [
        'cho_xac_nhan' => 'Chờ xác nhận',
        'cho_thanh_toan' => 'Chờ thanh toán',
        'da_xac_nhan' => 'Đã xác nhận',
        'chuan_bi_hang' => 'Chuẩn bị hàng',
        'dang_giao_hang' => 'Đang giao hàng',
        'giao_thanh_cong' => 'Giao thành công',
        'giao_that_bai' => 'Giao thất bại',
        'hoan_thanh' => 'Hoàn thành',
        'da_huy' => 'Đã hủy',
        // Trạng thái hoàn trả
        'yeu_cau_hoan_tra' => 'Yêu cầu hoàn trả',
        'da_phe_duyet' => 'Đã phê duyệt',
        'dang_tra_hang' => 'Đang trả hàng',
        'shop_da_nhan_hang' => 'Shop đã nhận hàng',
        'da_hoan_tien' => 'Đã hoàn tiền',
        'tu_choi_hoan' => 'Từ chối hoàn tiền',
    ];


    /**
     * Map trạng thái đơn hàng sang tiếng Việt.
     */
    public static function getTenTrangThai($trangThai)
    {

        $danhSach = [
            'cho_xac_nhan' => 'Chờ xác nhận',
            'cho_thanh_toan' => 'Chờ thanh toán',
            'da_xac_nhan' => 'Đã xác nhận',
            'chuan_bi_hang' => 'Chuẩn bị hàng',
            'dang_giao_hang' => 'Đang giao hàng',
            'giao_thanh_cong' => 'Giao thành công',
            'giao_that_bai' => 'Giao thất bại',
            'hoan_thanh' => 'Hoàn thành',
            'da_huy' => 'Đã hủy',
            'yeu_cau_hoan_tra' => 'Yêu cầu hoàn trả',
            'da_phe_duyet' => 'Đã phê duyệt',
            'dang_tra_hang' => 'Đang trả hàng',
            'shop_da_nhan_hang' => 'Shop đã nhận hàng',
            'da_hoan_tien' => 'Đã hoàn tiền',
            'tu_choi_hoan_tien' => 'Từ chối hoàn tiền',
        ];

        return $danhSach[$trangThai] ?? $trangThai;
    }

  const TRANG_THAI_VC_GIAO_HANG = [
    'chua_giao'      => 'Chưa giao',
    'dang_giao'      => 'Đang giao',
    'da_giao'        => 'Đã giao',
    'giao_that_bai'  => 'Giao thất bại',
];

const TRANG_THAI_VC_HOAN_HANG = [
    'cho_khach_gui'  => 'Chờ khách gửi',
    'dang_tra'  => 'Đang trả hàng',
    'da_giao'        => 'Đã giao',
    'giao_that_bai'  => 'Giao thất bại',
];

public static function getTenTrangThaiVCGiaoHang($trangThai)
{
    return self::TRANG_THAI_VC_GIAO_HANG[$trangThai] ?? 'Không xác định';
}

public static function getTenTrangThaiVCHoanHang($trangThai)
{
    return self::TRANG_THAI_VC_HOAN_HANG[$trangThai] ?? 'Không xác định';
}



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tong_tien' => 'decimal:2', // Đảm bảo tong_tien được cast thành decimal với 2 chữ số thập phân
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime', // Cast deleted_at thành datetime
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the address used for the order.
     */
    public function diaChiNguoiDung()
    {
        return $this->belongsTo(DiaChiNguoiDung::class, 'id_dia_chi_nguoi_dungs');
    }

    /**
     * Get the payment method used for the order.
     */
    public function phuongThucThanhToan()
    {
        return $this->belongsTo(PhuongThucThanhToan::class, 'id_phuong_thuc_thanh_toan');
    }

    /**
     * Get the discount code used for the order.
     */
    public function maGiamGia()
    {
        return $this->belongsTo(MaGiamGia::class, 'id_ma_giam_gia');
    }

    /**
     * Get the order details for the order.
     */
    public function chiTietDonHangs()
    {
        // Mỗi đơn hàng có nhiều chi tiết đơn hàng.
        // Có thể cần withTrashed() khi eager load nếu muốn lấy cả các chi tiết đã bị xóa mềm (nếu ChiTietDonHang cũng có soft deletes)
        return $this->hasMany(ChiTietDonHang::class, 'id_don_hang');
    }
    /**
     * Một đơn hàng có thể có một yêu cầu hoàn trả.
     */
    public function yeuCauHoanTra()
    {
        return $this->hasOne(YeuCauHoanTra::class, 'id_don_hang');
    }

    public function anhMinhChungs()
{
    return $this->hasMany(AnhMinhChung::class, 'id_don_hang');
}

}
