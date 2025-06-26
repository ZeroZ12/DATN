<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($id)
    {
        $donHang = DonHang::where('id_user', Auth::id())
            ->where('id', $id)
            ->with([
                'phuongThucThanhToan',
                'maGiamGia',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->firstOrFail();

        return view('client.payment', compact('donHang'));
    }

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
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    if ($secureHash === $vnp_SecureHash) {
        $donHang = DonHang::find($request->vnp_TxnRef);

        if (!$donHang) {
            return "Không tìm thấy đơn hàng!";
        }

       if ($request->vnp_ResponseCode == '00') {
    // Thanh toán thành công
    $donHang->trang_thai = 'da_xac_nhan';
    $donHang->save();

    return redirect()->route('client.payment', ['id' => $donHang->id]);
} else {
    // Thanh toán thất bại
    $donHang->trang_thai = 'da_huy';
    $donHang->save();

    return redirect()->route('client.payment.fail', ['id' => $donHang->id]);
}

    } else {
        return "Chuỗi hash không hợp lệ!";
    }
}

}
