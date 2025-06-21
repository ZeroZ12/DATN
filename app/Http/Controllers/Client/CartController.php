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
            ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe'])
            ->first();

        if (!$gioHang) {
            $gioHang = GioHang::create([
                'id_user' => Auth::id(),
                'loai' => 'chinh'
            ]);
        }

        $total = $gioHang->chiTietGioHangs->sum(function($item) {
            return $item->so_luong * ($item->bienThe->gia ?? $item->sanPham->gia);
        });

        $maGiamGias = MaGiamGia::where('hoat_dong', true)->get();

        return view('client.cart', compact('gioHang', 'total', 'maGiamGias'));
    }

    public function add(Request $request)
    {
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

        if ($maGiamGia->dieu_kien > $cartTotal) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng chưa đủ điều kiện áp dụng mã giảm giá'
            ]);
        }

        // Cập nhật mã giảm giá cho giỏ hàng
        $gioHang->id_giam_gia = $maGiamGia->id;
        $gioHang->save();

        // Tính toán giá sau khi áp dụng mã giảm giá
        $discount = $maGiamGia->loai === 'percent'
            ? ($cartTotal * $maGiamGia->gia_tri / 100)
            : $maGiamGia->gia_tri;

        $finalTotal = max(0, $cartTotal - $discount);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'finalTotal' => $finalTotal
        ]);
    }

    public function checkout()
    {
        $gioHang = GioHang::where('id_user', Auth::id())->first();
        if (!$gioHang) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $chiTietGioHang = ChiTietGioHang::with(['sanPham', 'bienThe'])
            ->where('id_gio_hang', $gioHang->id)
            ->get();

        if ($chiTietGioHang->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $tongTien = $chiTietGioHang->sum(function ($item) {
            return $item->gia * $item->so_luong;
        });

        // Lấy thông tin địa chỉ của user
        $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())->first();

        return view('client.checkout', compact('chiTietGioHang', 'tongTien', 'diaChi'));
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
                ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe'])
                ->first();

            if (!$gioHang || $gioHang->chiTietGioHangs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng trống!'
                ], 400);
            }

            // Get user's default address
            $diaChi = DiaChiNguoiDung::where('id_user', Auth::id())->first();
            if (!$diaChi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng thêm địa chỉ giao hàng!'
                ], 400);
            }

            // Calculate total
            $tongTien = $gioHang->chiTietGioHangs->sum(function ($item) {
                return $item->gia * $item->so_luong;
            });

            // Create order
            $donHang = DonHang::create([
                'ma_don' => 'DH' . time(),
                'id_user' => Auth::id(),
                'id_dia_chi_nguoi_dungs' => $diaChi->id,
                'id_phuong_thuc_thanh_toan' => $request->payment_method,
                'tong_tien' => $tongTien,
                'trang_thai' => 'cho_xu_ly'
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

            return response()->json([
                'success' => true,
                'redirect_url' => route('client.payment', ['id' => $donHang->id])
            ]);

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
