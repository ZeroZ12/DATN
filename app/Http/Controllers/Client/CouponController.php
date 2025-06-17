<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaGiamGia;
use App\Models\GioHang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        try {
            $request->validate([
                'ma_giam_gia' => 'required|string'
            ]);

            $coupon = MaGiamGia::where('ma', $request->ma_giam_gia)
                ->where('hoat_dong', 1)
                ->where('ngay_bat_dau', '<=', Carbon::now())
                ->where('ngay_ket_thuc', '>=', Carbon::now())
                ->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn'
                ]);
            }

            // Lấy thông tin giỏ hàng để tính tổng tiền
            $gioHang = GioHang::where('id_user', Auth::id())
                ->where('loai', 'chinh')
                ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe'])
                ->first();

            if (!$gioHang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy giỏ hàng'
                ]);
            }

            $total = 0;

            foreach ($gioHang->chiTietGioHangs as $item) {
                $price = $item->bienThe->gia ?? $item->sanPham->gia;
                $total += $price * $item->so_luong;
            }

            // Tính giảm giá
            $discountAmount = 0;
            if ($coupon->loai === 'percent') {
                $discountAmount = $total * ($coupon->gia_tri / 100);
            } else {
                $discountAmount = $coupon->gia_tri;
            }

            $finalTotal = $total - $discountAmount;
            if ($finalTotal < 0) $finalTotal = 0;

            // Lưu mã giảm giá vào session
            session(['applied_coupon' => [
                'id' => $coupon->id,
                'ma' => $coupon->ma,
                'loai' => $coupon->loai,
                'gia_tri' => $coupon->gia_tri,
                'discount_amount' => $discountAmount
            ]]);

            return response()->json([
                'success' => true,
                'message' => 'Áp dụng mã giảm giá thành công',
                'originalTotal' => $total,
                'discountAmount' => $discountAmount,
                'finalTotal' => $finalTotal,
                'coupon' => [
                    'ma' => $coupon->ma,
                    'loai' => $coupon->loai,
                    'gia_tri' => $coupon->gia_tri
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeCoupon()
    {
        session()->forget('applied_coupon');

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa mã giảm giá'
        ]);
    }
}