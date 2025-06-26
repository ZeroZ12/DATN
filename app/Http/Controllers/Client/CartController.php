<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\MaGiamGia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\BienTheSanPham;
use App\Models\ChiTietGioHang;
use App\Models\DiaChiNguoiDung;
use App\Models\DonHang;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe', 'maGiamGia'])
            ->first();

        if (!$gioHang) {
            $gioHang = GioHang::create([
                'id_user' => Auth::id(),
                'loai' => 'chinh'
            ]);
        }

        $total = 0;
        foreach ($gioHang->chiTietGioHangs as $item) {
            $total += $item->so_luong * ($item->bienThe->gia ?? $item->sanPham->gia);
        }

        $maGiamGias = MaGiamGia::where('hoat_dong', true)->get();

        return view('client.cart', compact('gioHang', 'total', 'maGiamGias'));
    }

    public function add(Request $request)
    {
        Log::info('Cart add request', $request->all());
        try {
            // Kiểm tra user đã đăng nhập chưa
            if (!Auth::check()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng',
                        'redirect' => route('login')
                    ], 401);
                }
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
            }

            $request->validate([
                'san_pham_id' => 'required|exists:san_phams,id',
                'bien_the_id' => 'nullable|exists:bien_the_san_phams,id',
                'so_luong' => 'required|integer|min:1'
            ]);

            $user = Auth::user();
            $gioHang = GioHang::firstOrCreate([
                'id_user' => $user->id,
                'loai' => 'chinh'
            ]);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $chiTietGioHang = ChiTietGioHang::where('id_gio_hang', $gioHang->id)
                ->where('id_product', $request->san_pham_id)
                ->where('id_bien_the', $request->bien_the_id)
                ->first();

            if ($chiTietGioHang) {
                // Nếu đã có thì tăng số lượng
                $chiTietGioHang->so_luong += $request->so_luong;
                $chiTietGioHang->save();
            } else {
                // Nếu chưa có thì tạo mới
                $sanPham = SanPham::findOrFail($request->san_pham_id);

                // Kiểm tra bien_the_id có tồn tại không
                if ($request->bien_the_id) {
                    $bienThe = BienTheSanPham::findOrFail($request->bien_the_id);
                    $gia = $bienThe->gia;
                } else {
                    // Nếu không có biến thể, lấy giá từ sản phẩm chính
                    $gia = $sanPham->gia ?? 0;
                }

                ChiTietGioHang::create([
                    'id_gio_hang' => $gioHang->id,
                    'id_product' => $request->san_pham_id,
                    'id_bien_the' => $request->bien_the_id,
                    'so_luong' => $request->so_luong,
                    'gia' => $gia
                ]);
            }

            // Tính tổng số lượng sản phẩm trong giỏ hàng
            $cartCount = ChiTietGioHang::where('id_gio_hang', $gioHang->id)->sum('so_luong');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                    'cart_count' => $cartCount
                ]);
            }

            return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cart add error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'id_user' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng'
                ], 500);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'so_luong' => 'required|integer|min:1'
        ]);

        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->first();

        $chiTietGioHang = $gioHang->chiTietGioHangs()
            ->where('id', $id)
            ->firstOrFail();

        $chiTietGioHang->so_luong = $request->so_luong;
        $chiTietGioHang->save();

        $total = $gioHang->chiTietGioHangs()
            ->with(['sanPham', 'bienThe'])
            ->get()
            ->sum(function($item) {
                return $item->so_luong * ($item->bienThe->gia ?? $item->sanPham->gia);
            });

        return response()->json([
            'success' => true,
            'total' => $total
        ]);
    }

    public function remove($id)
    {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->first();

        $chiTietGioHang = $gioHang->chiTietGioHangs()
            ->where('id', $id)
            ->firstOrFail();

        $chiTietGioHang->delete();

        $total = $gioHang->chiTietGioHangs()
            ->with(['sanPham', 'bienThe'])
            ->get()
            ->sum(function($item) {
                return $item->so_luong * ($item->bienThe->gia ?? $item->sanPham->gia);
            });

        return response()->json([
            'success' => true,
            'total' => $total,
            'cartEmpty' => $gioHang->chiTietGioHangs()->count() === 0
        ]);
    }

    public function count()
    {
        if(!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->first();

        if (!$gioHang) {
            return response()->json(['count' => 0]);
        }

        $count = ChiTietGioHang::where('id_gio_hang', $gioHang->id)->sum('so_luong');
        return response()->json(['count' => $count]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'ma_giam_gia' => 'required|exists:ma_giam_gias,ma'
        ]);

        $maGiamGia = MaGiamGia::where('ma', $request->ma_giam_gia)
            ->where('hoat_dong', true)
            ->first();

        if (!$maGiamGia) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ'
            ]);
        }

        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->first();

        if (!$gioHang) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng không tồn tại'
            ]);
        }

        // Kiểm tra điều kiện áp dụng mã giảm giá
        $cartTotal = $gioHang->chiTietGioHangs()
            ->with(['sanPham', 'bienThe'])
            ->get()
            ->sum(function($item) {
                return $item->so_luong * ($item->bienThe->gia ?? $item->sanPham->gia);
            });

        if ($maGiamGia->dieu_kien > 0 && $cartTotal < $maGiamGia->dieu_kien) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng chưa đủ điều kiện áp dụng mã giảm giá (tối thiểu ' . number_format($maGiamGia->dieu_kien) . '₫)'
            ]);
        }

        // Cập nhật mã giảm giá cho giỏ hàng
        $gioHang->id_giam_gia = $maGiamGia->id;
        $gioHang->save();

        // Tính toán giá sau khi áp dụng mã giảm giá
        $discount = $maGiamGia->loai === 'phan_tram'
            ? ($cartTotal * $maGiamGia->gia_tri / 100)
            : $maGiamGia->gia_tri;

        $finalTotal = max(0, $cartTotal - $discount);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'finalTotal' => $finalTotal,
            'originalTotal' => $cartTotal
        ]);
    }

    public function removeCoupon()
    {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->first();

        if ($gioHang) {
            $gioHang->id_giam_gia = null;
            $gioHang->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa mã giảm giá'
        ]);
    }

    public function checkout()
    {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe', 'maGiamGia'])
            ->first();
        if (!$gioHang) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $chiTietGioHang = ChiTietGioHang::with(['sanPham', 'bienThe'])
            ->where('id_gio_hang', $gioHang->id)
            ->get();

        if ($chiTietGioHang->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền gốc
        $tongTienGoc = $chiTietGioHang->sum(function ($item) {
            return $item->gia * $item->so_luong;
        });

        // Tính toán giảm giá nếu có mã giảm giá
        $giamGia = 0;
        $tongTienSauGiam = $tongTienGoc;

        if ($gioHang->maGiamGia) {
            if ($gioHang->maGiamGia->loai === 'phan_tram') {
                $giamGia = $tongTienGoc * ($gioHang->maGiamGia->gia_tri / 100);
            } else {
                $giamGia = $gioHang->maGiamGia->gia_tri;
            }
            $tongTienSauGiam = max(0, $tongTienGoc - $giamGia);
        }

        // Lấy thông tin địa chỉ của user
        $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())
            ->where('mac_dinh', true)
            ->first();

        if (!$diaChi) {
            $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())->first();
        }

        return view('client.checkout', compact('chiTietGioHang', 'tongTienGoc', 'giamGia', 'tongTienSauGiam', 'diaChi', 'gioHang'));
    }

    // public function placeOrder(Request $request)
    // {
    //     try {
    //         // Validate request
    //         $validator = Validator::make($request->all(), [
    //             'payment_method' => 'required|exists:phuong_thuc_thanh_toans,id'
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Dữ liệu không hợp lệ',
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }

    //         // Get cart
    //         $gioHang = GioHang::where('id_user', Auth::id())
    //             ->where('loai', 'chinh')
    //             ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe', 'maGiamGia'])
    //             ->first();

    //         if (!$gioHang || $gioHang->chiTietGioHangs->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Giỏ hàng trống!'
    //             ], 400);
    //         }

    //         // Get user's default address
    //         $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())
    //             ->where('mac_dinh', true)
    //             ->first();

    //         if (!$diaChi) {
    //             $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())->first();
    //         }

    //         if (!$diaChi) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Vui lòng thêm địa chỉ giao hàng!'
    //             ], 400);
    //         }

    //         // Calculate total
    //         $tongTienGoc = $gioHang->chiTietGioHangs->map(function ($item) {
    //             return $item->gia * $item->so_luong;
    //         })->sum();

    //         // Tính toán giảm giá nếu có mã giảm giá
    //         $giamGia = 0;
    //         $tongTienSauGiam = $tongTienGoc;

    //         if ($gioHang->maGiamGia) {
    //             if ($gioHang->maGiamGia->loai === 'phan_tram') {
    //                 $giamGia = $tongTienGoc * ($gioHang->maGiamGia->gia_tri / 100);
    //             } else {
    //                 $giamGia = $gioHang->maGiamGia->gia_tri;
    //             }
    //             $tongTienSauGiam = max(0, $tongTienGoc - $giamGia);
    //         }

    //         // Create order
    //         $donHang = DonHang::create([
    //             'ma_don' => 'DH' . time(),
    //             'id_user' => Auth::id(),
    //             'id_dia_chi_nguoi_dungs' => $diaChi->id,
    //             'id_phuong_thuc_thanh_toan' => $request->payment_method,
    //             'id_ma_giam_gia' => $gioHang->id_giam_gia,
    //             'tong_tien' => $tongTienSauGiam,
    //             'tong_tien_goc' => $tongTienGoc,
    //             'giam_gia' => $giamGia,
    //             'trang_thai' => 'cho_xac_nhan'
    //         ]);

    //         // Create order details
    //         foreach ($gioHang->chiTietGioHangs as $item) {
    //             $donHang->chiTietDonHangs()->create([
    //                 'id_product' => $item->id_product,
    //                 'id_bien_the' => $item->id_bien_the,
    //                 'ten_hien_thi' => $item->sanPham->ten,
    //                 'so_luong' => $item->so_luong,
    //                 'don_gia' => $item->gia,
    //                 'bao_hanh_thang' => $item->sanPham->bao_hanh_thang
    //             ]);
    //         }

    //         // Clear cart
    //         $gioHang->chiTietGioHangs()->delete();
    //         $gioHang->id_giam_gia = null;
    //         $gioHang->save();

    //         return response()->json([
    //             'success' => true,
    //             'redirect_url' => route('client.payment', ['id' => $donHang->id])
    //         ]);

    //     } catch (\Exception $e) {
    //         \Illuminate\Support\Facades\Log::error('Place order error: ' . $e->getMessage(), [
    //             'request' => $request->all(),
    //             'id_user' => Auth::id(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Có lỗi xảy ra khi đặt hàng: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function buyNow(Request $request)
    {
        try {
            // Kiểm tra user đã đăng nhập chưa
            if (!Auth::check()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng đăng nhập để mua sản phẩm',
                        'redirect' => route('login')
                    ], 401);
                }
                return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để mua sản phẩm');
            }

            $request->validate([
                'san_pham_id' => 'required|exists:san_phams,id',
                'bien_the_id' => 'nullable|exists:bien_the_san_phams,id',
                'so_luong' => 'required|integer|min:1'
            ]);

            $user = Auth::user();
            $gioHang = GioHang::firstOrCreate([
                'id_user' => $user->id,
                'loai' => 'chinh'
            ]);

            // Xóa tất cả sản phẩm trong giỏ hàng hiện tại
            ChiTietGioHang::where('id_gio_hang', $gioHang->id)->delete();

            // Thêm sản phẩm mới vào giỏ hàng
            $sanPham = SanPham::findOrFail($request->san_pham_id);

            // Kiểm tra bien_the_id có tồn tại không
            if ($request->bien_the_id) {
                $bienThe = BienTheSanPham::findOrFail($request->bien_the_id);
                $gia = $bienThe->gia;
            } else {
                // Nếu không có biến thể, lấy giá từ sản phẩm chính
                $gia = $sanPham->gia ?? 0;
            }

            ChiTietGioHang::create([
                'id_gio_hang' => $gioHang->id,
                'id_product' => $request->san_pham_id,
                'id_bien_the' => $request->bien_the_id,
                'so_luong' => $request->so_luong,
                'gia' => $gia
            ]);

            // Tính tổng số lượng sản phẩm trong giỏ hàng
            $cartCount = ChiTietGioHang::where('id_gio_hang', $gioHang->id)->sum('so_luong');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm sản phẩm vào giỏ hàng và chuyển hướng',
                    'cart_count' => $cartCount,
                    'redirect' => route('client.cart.index')
                ]);
            }

            return redirect()->route('client.cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Buy now error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'id_user' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi mua sản phẩm'
                ], 500);
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi mua sản phẩm');
        }
    }
 public function placeOrder(Request $request)
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'payment_method' => 'required|exists:phuong_thuc_thanh_toans,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get cart
            $gioHang = GioHang::where('id_user', Auth::id())
                ->where('loai', 'chinh')
                ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe', 'maGiamGia'])
                ->first();

            if (!$gioHang || $gioHang->chiTietGioHangs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng trống!'
                ], 400);
            }

            // Get user's default address
            $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())
                ->where('mac_dinh', true)
                ->first();

            if (!$diaChi) {
                $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())->first();
            }

            if (!$diaChi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng thêm địa chỉ giao hàng!'
                ], 400);
            }

            // Calculate total
            $tongTienGoc = $gioHang->chiTietGioHangs->map(function ($item) {
                return $item->gia * $item->so_luong;
            })->sum();

            // Tính toán giảm giá nếu có mã giảm giá
            $giamGia = 0;
            $tongTienSauGiam = $tongTienGoc;

            if ($gioHang->maGiamGia) {
                if ($gioHang->maGiamGia->loai === 'phan_tram') {
                    $giamGia = $tongTienGoc * ($gioHang->maGiamGia->gia_tri / 100);
                } else {
                    $giamGia = $gioHang->maGiamGia->gia_tri;
                }
                $tongTienSauGiam = max(0, $tongTienGoc - $giamGia);
            }

            // Create order
            $donHang = DonHang::create([
                'ma_don' => 'DH' . time(),
                'id_user' => Auth::id(),
                'id_dia_chi_nguoi_dungs' => $diaChi->id,
                'id_phuong_thuc_thanh_toan' => $request->payment_method,
                'id_ma_giam_gia' => $gioHang->id_giam_gia,
                'tong_tien' => $tongTienSauGiam,
                'tong_tien_goc' => $tongTienGoc,
                'giam_gia' => $giamGia,
                'trang_thai' => $request->payment_method == 2 ? 'cho_thanh_toan' : 'cho_xac_nhan'

            ]);

            // Create order details
            foreach ($gioHang->chiTietGioHangs as $item) {
                $donHang->chiTietDonHangs()->create([
                    'id_product' => $item->id_product,
                    'id_bien_the' => $item->id_bien_the,
                    'ten_hien_thi' => $item->sanPham->ten,
                    'so_luong' => $item->so_luong,
                    'don_gia' => $item->gia,
                    'bao_hanh_thang' => $item->sanPham->bao_hanh_thang
                ]);
            }

           // Clear cart
$gioHang->chiTietGioHangs()->delete();
$gioHang->id_giam_gia = null;
$gioHang->save();

if ($request->payment_method == 2) { // Giả sử ID 2 là phương thức VNPay
    // Chuẩn bị dữ liệu cho VNPay
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route('client.vnpay.return');
    $vnp_TmnCode = "3D6CARP9";
    $vnp_HashSecret = "VZ4OJHBNFW0TL0DNSY6HFY7P23HKKSDG";

    $vnp_TxnRef = $donHang->id;
    $vnp_Amount = $donHang->tong_tien * 100;
    $vnp_OrderInfo = "Thanh toán đơn hàng #" . $donHang->ma_don;
    $vnp_OrderType = "pay";
    $vnp_Locale = "vn";
    $vnp_BankCode = "";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    );

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return response()->json([
        'success' => true,
        'redirect_url' => $vnp_Url
    ]);
} else {
    return response()->json([
        'success' => true,
        'redirect_url' => route('client.payment', ['id' => $donHang->id])
    ]);
}

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Place order error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'id_user' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi đặt hàng: ' . $e->getMessage()
            ], 500);
        }
    }


}
