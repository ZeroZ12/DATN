<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Trang thanh toán
    public function index($id)
    {
        $donHang = DonHang::where('id_user', Auth::id())
            ->where('id', $id)
            ->with([
                'phuongThucThanhToan',
                'maGiamGia',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.sanPham.suKien' => function($q) {
                    $q->where('su_kien_san_phams.hien_thi', 1)
                      ->where('ngay_ket_thuc', '>=', now())
                      ->orderByDesc('ngay_bat_dau');
                },
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.suKien' => function($q) {
                    $q->where('su_kien_san_phams.hien_thi', 1)
                      ->where('ngay_ket_thuc', '>=', now())
                      ->orderByDesc('ngay_bat_dau');
                },
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung',
            ])
            ->firstOrFail();

        return view('client.payment', compact('donHang'));
    }

    // Callback VNPay
    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "VZ4OJHBNFW0TL0DNSY6HFY7P23HKKSDG"; // Secret key
        $inputData = $request->all();

        if (!isset($inputData['vnp_SecureHash'])) {
            return "Thiếu thông tin bảo mật!";
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = '';
        $i = 0;
        foreach ($inputData as $key => $value) {
            $hashData .= ($i == 1 ? '&' : '') . urlencode($key) . '=' . urlencode($value);
            $i = 1;
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            return "Chuỗi hash không hợp lệ!";
        }

        // Tìm đơn hàng theo mã đơn (ma_don)
        $donHang = DonHang::where('ma_don', $request->vnp_TxnRef)->first();
        if (!$donHang) {
            return "Không tìm thấy đơn hàng!";
        }

        // Xử lý trạng thái
        if ($request->vnp_ResponseCode == '00') {
            $donHang->trang_thai = 'da_xac_nhan'; // thanh toán thành công
            $donHang->save();

            return redirect()->route('client.payment', ['id' => $donHang->id]);
        } else {
            $donHang->trang_thai = 'da_huy'; // thanh toán thất bại / hủy
            $donHang->huy_boi = 'khach_hang';
            $donHang->save();

            return redirect()->route('client.payment.fail', ['id' => $donHang->id]);
        }
    }

    // Trang thanh toán thất bại
    public function paymentFail($id)
    {
        $donHang = DonHang::findOrFail($id);
        return view('client.payment_fail', compact('donHang'));
    }
}
