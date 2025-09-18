<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OrderSuccessMail;
use Illuminate\Support\Facades\Mail;
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
use App\Models\MaGiamGiaUser;
use App\Models\SuKienSanPham;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getprice($sanPhamId, $bienTheId = null) {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe.ram', 'chiTietGioHangs.bienThe.oCung', 'maGiamGia'])
            ->first();

        $now = now();

        $flashSale = SuKienSanPham::with('suKien')
            ->where('hien_thi', 1)
            ->whereHas('suKien', function ($q) use ($now) {
                $q->where('ngay_bat_dau', '<=', $now)
                ->where('ngay_ket_thuc', '>=', $now);
            })
            ->where(function ($q) use ($sanPhamId, $bienTheId) {
                $q->where('id_san_pham', $sanPhamId);
                if (!empty($bienTheId)) {
                    $q->orWhere('id_bien_the_san_pham', $bienTheId);
                }
            })
            ->first();

        $originalPrice = $bienTheId
            ? (BienTheSanPham::find($bienTheId)->gia ?? 0)
            : (SanPham::find($sanPhamId)->gia ?? 0);

        if (! $flashSale) {
            return $originalPrice;
        }

        // if ($flashSale) {
            $SLFlashSale = ChiTietGioHang::where('id_product', $sanPhamId)
                ->where('id_bien_the', $bienTheId)
                ->where('id_gio_hang', $gioHang->id)
                ->sum('so_luong');

            if ($SLFlashSale >= ($flashSale->so_luong_gioi_han ?? 0)) {
            // đã vượt hạn mức -> trả về giá gốc
            return $originalPrice;
        }

        return $flashSale->gia_su_kien;
    }

    public function index()
    {
        $gioHang = GioHang::where('id_user', Auth::id())
            ->where('loai', 'chinh')
            ->with(['chiTietGioHangs.sanPham', 'chiTietGioHangs.bienThe.ram', 'chiTietGioHangs.bienThe.oCung', 'maGiamGia'])
            ->first();

        if (!$gioHang) {
            $gioHang = GioHang::create([
                'id_user' => Auth::id(),
                'loai' => 'chinh'
            ]);
        }

        $total = 0;

        foreach ($gioHang->chiTietGioHangs as $item) {
            $gia = $item->gia_hien_thi ?? ($item->bienThe->gia ?? $item->sanPham->gia);
            $total += $item->so_luong * $gia;
        }

        $maGiamGias = MaGiamGia::query()
        ->leftJoin('ma_giam_gia_users as mgg_user', function($join)
        {
            $join->on('ma_giam_gias.id','=', 'mgg_user.ma_giam_gia_id') # Kiểm tra xem user đã từng sử dụng mã giảm giá nào chưa
            ->where('mgg_user.user_id','=',Auth::id());
        })
        ->where(function ($query)
        {
            $query->whereNull('mgg_user.so_lan_su_dung')
            ->orWhereColumn('mgg_user.so_lan_su_dung','<','ma_giam_gias.gioi_han_moi_user'); # Nếu như chưa từng dùng hoặc vẫn còn lượt thì lấy ra
        })
        ->where('hoat_dong', true)
        ->where('ngay_ket_thuc','>', now())
        ->where('so_luong', '>', 0)->get();
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

            $soLuongMuonThem = $request->so_luong;
            $soLuongHienTaiTrongGio = $chiTietGioHang ? $chiTietGioHang->so_luong : 0;
            $tongSoLuongSauKhiThem = $soLuongHienTaiTrongGio + $soLuongMuonThem;

            $gia = null;
            $bienThe = null;
            $sanPham = null;
            $saleEvent = null;

            // Kiểm tra tồn kho và tính giá trước khi thực hiện bất kỳ thay đổi nào
            if ($request->bien_the_id) {
                $bienThe = BienTheSanPham::findOrFail($request->bien_the_id);

                // Kiểm tra tồn kho trước
                if ($soLuongMuonThem > $bienThe->ton_kho) {
                    $message = 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!';
                    return response()->json(['success' => false, 'message' => $message], 400);
                }

                $saleEvent = SuKienSanPham::where('id_bien_the_san_pham', $bienThe->id)
                    ->where('hien_thi', 1)
                    ->whereHas('suKien', function ($q) {
                        $q->where('ngay_bat_dau', '<=', now())
                        ->where('ngay_ket_thuc', '>=', now());
                    })->first();

                if ($saleEvent) {
                    $soLuongDaBan = ChiTietGioHang::where('id_bien_the', $bienThe->id)
                        ->whereHas('gioHang', function ($q) {
                            $q->where('loai', 'chinh');
                        })->sum('so_luong');

                    $soLuongConLaiFlashSale = $saleEvent->so_luong_gioi_han - $soLuongDaBan;

                    if ($soLuongConLaiFlashSale >= $soLuongMuonThem) {
                        $gia = $saleEvent->gia_su_kien;
                    } else {
                        if ($soLuongMuonThem <= $bienThe->ton_kho) {
                            $gia = $bienThe->gia;
                        } else {
                            $message = 'Sản phẩm đã hết hàng!';
                            return response()->json(['success' => false, 'message' => $message], 400);
                        }
                    }
                } else {
                    $gia = $bienThe->gia; // Không có Flash Sale, dùng giá gốc
                }
            } else {
                $sanPham = SanPham::findOrFail($request->san_pham_id);

                // Kiểm tra tồn kho trước
                if ($soLuongMuonThem > $sanPham->so_luong) {
                    $message = 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!';
                    return response()->json(['success' => false, 'message' => $message], 400);
                }

                $saleEvent = SuKienSanPham::where('id_san_pham', $sanPham->id)
                    ->where('hien_thi', 1)
                    ->whereHas('suKien', function ($q) {
                        $q->where('ngay_bat_dau', '<=', now())
                        ->where('ngay_ket_thuc', '>=', now());
                    })->first();

                if ($saleEvent) {
                    $soLuongDaBan = ChiTietGioHang::where('id_product', $sanPham->id)
                        ->whereHas('gioHang', function ($q) {
                            $q->where('loai', 'chinh');
                        })->sum('so_luong');

                    $soLuongConLaiFlashSale = $saleEvent->so_luong_gioi_han - $soLuongDaBan;

                    if ($soLuongConLaiFlashSale >= $soLuongMuonThem) {
                        $gia = $saleEvent->gia_su_kien;
                    } else {
                        if ($soLuongMuonThem <= $sanPham->so_luong) {
                            $gia = $sanPham->gia; // Chuyển sang giá gốc
                        } else {
                            $message = 'Sản phẩm đã hết hàng!';
                            return response()->json(['success' => false, 'message' => $message], 400);
                        }
                    }
                } else {
                    $gia = $sanPham->gia; // Không có Flash Sale, dùng giá gốc
                }
            }

            // Kiểm tra giá hợp lệ trước khi thực hiện bất kỳ thay đổi nào
            if ($gia === null) {
                return response()->json(['success' => false, 'message' => 'Giá sản phẩm không hợp lệ!'], 400);
            }

            // Bắt đầu transaction để đảm bảo tính nhất quán
            DB::beginTransaction();
            try {
                // Giảm tồn kho và cập nhật flash sale
                if ($request->bien_the_id) {
                    $bienThe->ton_kho -= $soLuongMuonThem;
                    $bienThe->save();

                    if ($saleEvent && $saleEvent->gia_su_kien == $gia) {
                        $saleEvent->so_luong_gioi_han -= $soLuongMuonThem;
                        $saleEvent->save();
                    }
                } else {
                    $sanPham->so_luong -= $soLuongMuonThem;
                    $sanPham->save();

                    if ($saleEvent && $saleEvent->gia_su_kien == $gia) {
                        $saleEvent->so_luong_gioi_han -= $soLuongMuonThem;
                        $saleEvent->save();
                    }
                }

                // Thêm hoặc cập nhật giỏ hàng
                if ($chiTietGioHang) {
                    $chiTietGioHang->so_luong = $tongSoLuongSauKhiThem;
                    $chiTietGioHang->gia = $gia; // cập nhật theo giá hiện tại (ưu tiên flash sale)
                    $chiTietGioHang->save();
                } else {
                    ChiTietGioHang::create([
                        'id_gio_hang' => $gioHang->id,
                        'id_product' => $request->san_pham_id,
                        'id_bien_the' => $request->bien_the_id,
                        'so_luong' => $soLuongMuonThem,
                        'gia' => $gia
                    ]);
                }

                DB::commit();

                // Tính tổng số lượng sản phẩm trong giỏ hàng
                $cartCount = ChiTietGioHang::where('id_gio_hang', $gioHang->id)->sum('so_luong');

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                        'cart_count' => $cartCount,
                        'updated_stock' => $bienThe ? $bienThe->ton_kho : $sanPham->so_luong,
                        'updated_sale_stock' => $saleEvent ? $saleEvent->so_luong_gioi_han : null
                    ]);
                }

                return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Cart add error: ' . $e->getMessage(), [
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
        try {
            $request->validate([
                'so_luong' => 'required|integer|min:1'
            ]);

            $gioHang = GioHang::where('id_user', Auth::id())
                ->where('loai', 'chinh')
                ->first();

            if (!$gioHang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng không tồn tại'
                ], 404);
            }

            $chiTietGioHang = $gioHang->chiTietGioHangs()
                ->where('id', $id)
                ->first();

            if (!$chiTietGioHang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng'
                ], 404);
            }

            $soLuongMoi = $request->so_luong;
            $soLuongThayDoi = $soLuongMoi - $chiTietGioHang->so_luong;

            // Kiểm tra tồn kho trước khi cập nhật
            if ($chiTietGioHang->id_bien_the) {
                $bienThe = BienTheSanPham::findOrFail($chiTietGioHang->id_bien_the);

                // Kiểm tra xem có đủ tồn kho không (đã trừ đi số lượng hiện tại trong giỏ hàng)
                if ($soLuongMoi > $bienThe->ton_kho) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!',
                        'currentQuantity' => $chiTietGioHang->so_luong
                    ], 400);
                }
            } else {
                $sanPham = SanPham::findOrFail($chiTietGioHang->id_product);

                // Kiểm tra xem có đủ tồn kho không (đã trừ đi số lượng hiện tại trong giỏ hàng)
                if ($soLuongMoi > $sanPham->so_luong) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!',
                        'currentQuantity' => $chiTietGioHang->so_luong
                    ], 400);
                }
            }

            // Bắt đầu transaction
            DB::beginTransaction();
            try {
                // Cập nhật tồn kho
                if ($chiTietGioHang->id_bien_the) {
                    $bienThe = BienTheSanPham::findOrFail($chiTietGioHang->id_bien_the);
                    $bienThe->ton_kho -= $soLuongThayDoi;
                    $bienThe->save();

                    // Cập nhật Flash Sale nếu có
                    $saleEvent = SuKienSanPham::where('id_bien_the_san_pham', $bienThe->id)
                        ->where('hien_thi', 1)
                        ->whereHas('suKien', function ($q) {
                            $q->where('ngay_bat_dau', '<=', now())
                            ->where('ngay_ket_thuc', '>=', now());
                        })->first();

                    if ($saleEvent) {
                        $saleEvent->so_luong_gioi_han -= $soLuongThayDoi;
                        $saleEvent->save();
                    }
                } else {
                    $sanPham = SanPham::findOrFail($chiTietGioHang->id_product);
                    $sanPham->so_luong -= $soLuongThayDoi;
                    $sanPham->save();

                    // Cập nhật Flash Sale nếu có
                    $saleEvent = SuKienSanPham::where('id_san_pham', $sanPham->id)
                        ->where('hien_thi', 1)
                        ->whereHas('suKien', function ($q) {
                            $q->where('ngay_bat_dau', '<=', now())
                            ->where('ngay_ket_thuc', '>=', now());
                        })->first();

                    if ($saleEvent) {
                        $saleEvent->so_luong_gioi_han -= $soLuongThayDoi;
                        $saleEvent->save();
                    }
                }

                // Cập nhật số lượng trong giỏ hàng
                $chiTietGioHang->so_luong = $soLuongMoi;
                $chiTietGioHang->save();

                DB::commit();

                // Tính tổng tiền
                $total = $gioHang->chiTietGioHangs()
                    ->with(['sanPham', 'bienThe'])
                    ->get()
                    ->sum(function ($item) {
                        $gia = $item->gia_hien_thi ?? ($item->bienThe->gia ?? $item->sanPham->gia);
                        return $item->so_luong * $gia;
                    });

                // Tính toán giảm giá nếu có mã giảm giá
                $discount = 0;
                $originalTotal = $total;
                $finalTotal = $total;

                if ($gioHang->maGiamGia) {
                    if ($gioHang->maGiamGia->loai === 'phan_tram') {
                        $discount = $total * ($gioHang->maGiamGia->gia_tri / 100);
                    } else {
                        $discount = $gioHang->maGiamGia->gia_tri;
                    }

                    if (isset($gioHang->maGiamGia->gia_tri_toi_da) && $discount > $gioHang->maGiamGia->gia_tri_toi_da) {
                        $discount = min($discount, $gioHang->maGiamGia->gia_tri_toi_da);
                    }
                    $finalTotal = max(0, $total - $discount);
                }

                return response()->json([
                    'success' => true,
                    'total' => $total,
                    'originalTotal' => $originalTotal,
                    'discount' => $discount,
                    'finalTotal' => $finalTotal
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Cart update error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'id_user' => Auth::id(),
                'item_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật số lượng'
            ], 500);
        }
    }

    public function remove($id)
    {
        try {
            $gioHang = GioHang::where('id_user', Auth::id())
                ->where('loai', 'chinh')
                ->first();

            if (!$gioHang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Giỏ hàng không tồn tại'
                ], 404);
            }

            $chiTietGioHang = $gioHang->chiTietGioHangs()
                ->where('id', $id)
                ->first();

            if (!$chiTietGioHang) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng'
                ], 404);
            }

            // Bắt đầu transaction
            DB::beginTransaction();
            try {
                // Hoàn trả tồn kho và Flash Sale
                if ($chiTietGioHang->id_bien_the) {
                    $bienThe = BienTheSanPham::findOrFail($chiTietGioHang->id_bien_the);
                    $bienThe->ton_kho += $chiTietGioHang->so_luong;
                    $bienThe->save();

                    $saleEvent = SuKienSanPham::where('id_bien_the_san_pham', $bienThe->id)
                        ->where('hien_thi', 1)
                        ->whereHas('suKien', function ($q) {
                            $q->where('ngay_bat_dau', '<=', now())
                            ->where('ngay_ket_thuc', '>=', now());
                        })->first();

                    if ($saleEvent) {
                        $saleEvent->so_luong_gioi_han += $chiTietGioHang->so_luong;
                        $saleEvent->save();
                    }
                } else {
                    $sanPham = SanPham::findOrFail($chiTietGioHang->id_product);
                    $sanPham->so_luong += $chiTietGioHang->so_luong;
                    $sanPham->save();

                    $saleEvent = SuKienSanPham::where('id_san_pham', $sanPham->id)
                        ->where('hien_thi', 1)
                        ->whereHas('suKien', function ($q) {
                            $q->where('ngay_bat_dau', '<=', now())
                            ->where('ngay_ket_thuc', '>=', now());
                        })->first();

                    if ($saleEvent) {
                        $saleEvent->so_luong_gioi_han += $chiTietGioHang->so_luong;
                        $saleEvent->save();
                    }
                }

                // Xóa sản phẩm khỏi giỏ hàng
                $chiTietGioHang->delete();

                DB::commit();

                // Tính tổng tiền mới
                $total = $gioHang->chiTietGioHangs()
                    ->with(['sanPham', 'bienThe'])
                    ->get()
                    ->sum(function ($item) {
                        $gia = $item->gia_hien_thi ?? ($item->bienThe->gia ?? $item->sanPham->gia);
                        return $item->so_luong * $gia;
                    });

                // Tính toán giảm giá nếu có mã giảm giá
                $discount = 0;
                $originalTotal = $total;
                $finalTotal = $total;

                if ($gioHang->maGiamGia) {
                    if ($gioHang->maGiamGia->loai === 'phan_tram') {
                        $discount = $total * ($gioHang->maGiamGia->gia_tri / 100);
                    } else {
                        $discount = $gioHang->maGiamGia->gia_tri;
                    }

                    if (isset($gioHang->maGiamGia->gia_tri_toi_da) && $discount > $gioHang->maGiamGia->gia_tri_toi_da) {
                        $discount = min($discount, $gioHang->maGiamGia->gia_tri_toi_da);
                    }
                    $finalTotal = max(0, $total - $discount);
                }

                return response()->json([
                    'success' => true,
                    'total' => $total,
                    'originalTotal' => $originalTotal,
                    'discount' => $discount,
                    'finalTotal' => $finalTotal,
                    'cartEmpty' => $gioHang->chiTietGioHangs()->count() === 0
                ]);

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Cart remove error: ' . $e->getMessage(), [
                'id_user' => Auth::id(),
                'item_id' => $id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa sản phẩm'
            ], 500);
        }
    }

    public function count()
    {
        if (!Auth::check()) {
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
            ->where('so_luong', '>', 0)
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
            ->sum(function ($item) {
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
        if (isset($maGiamGia->gia_tri_toi_da) && $discount > $maGiamGia->gia_tri_toi_da) {
            $discount = min($discount, $maGiamGia->gia_tri_toi_da);
        }
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

        $chiTietGioHang = ChiTietGioHang::with([
            'sanPham.suKien',
            'bienThe.suKien'
        ])
        ->where('id_gio_hang', $gioHang->id)
        ->get();

        if ($chiTietGioHang->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền gốc
        $now = now();
        $tongTienGoc = $chiTietGioHang->sum(function ($item) use ($now) {
            // Mặc định lấy giá gốc
            $gia = null;

            if ($item->bienThe) {
                if ($item->bienThe->SuKienSanPham) {
                    $SuKien = $item->bienThe->SuKienSanPham->SuKien;
                    if ($SuKien && $SuKien->hien_thi && $SuKien->ngay_bat_dau <= now() && $SuKien->ngay_ket_thuc >= now()) {
                        $gia = $item->bienThe->SuKienSanPham->gia_su_kien;
                    } else {
                        $gia = $this->getprice($item->id_product, $item->id_bien_the);
                    }
                } else {
                    $gia = $this->getprice($item->id_product, $item->id_bien_the);
                }
            } else {
                if ($item->sanPham) {
                    if ($item->sanPham->SuKienSanPham) {
                        $SuKien = $item->sanPham->SuKienSanPham->SuKien;
                        if ($SuKien && $SuKien->hien_thi && $SuKien->ngay_bat_dau <= now() && $SuKien->ngay_ket_thuc >= now()) {
                            $gia = $item->sanPham ->SuKienSanPham->gia_su_kien;
                        } else {
                            $gia = $this->getprice($item->id_product, $item->id_san_pham);
                        }
                    } else {
                        $gia = $this->getprice($item->id_product, $item->id_san_pham);
                    }
                }
            }

            if (!$gia) {
                $gia = $item->bienThe->gia ?? $item->sanPham->gia;
            }

            return $gia * $item->so_luong;
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
            if (isset($gioHang->maGiamGia->gia_tri_toi_da) && $giamGia > $gioHang->maGiamGia->gia_tri_toi_da) {
                $giamGia = min($giamGia, $gioHang->maGiamGia->gia_tri_toi_da);
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
        // Load dữ liệu từ file JSON trong public/assets/data
        $tinhData = json_decode(file_get_contents(public_path('assets/data/tinh_tp.json')), true);
        $xaData = json_decode(file_get_contents(public_path('assets/data/xa_phuong.json')), true);

        // Nếu có địa chỉ thì gán tên địa phương
        if ($diaChi) {
            $diaChi->tinh_thanh_pho = $tinhData[$diaChi->tinh_thanh_pho]['name_with_type'] ?? $diaChi->tinh_thanh_pho;
            $diaChi->phuong_xa = $xaData[$diaChi->phuong_xa]['name_with_type'] ?? $diaChi->phuong_xa;
        }


        return view('client.checkout', compact('chiTietGioHang', 'tongTienGoc', 'giamGia', 'tongTienSauGiam', 'diaChi', 'gioHang'));
    }

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

            // Kiểm tra tồn kho và tính giá trước khi thực hiện bất kỳ thay đổi nào
            $soLuongMuonThem = $request->so_luong;
            $gia = null;
            $bienThe = null;
            $sanPham = null;
            $saleEvent = null;

            if ($request->bien_the_id) {
                $bienThe = BienTheSanPham::findOrFail($request->bien_the_id);
                if ($soLuongMuonThem > $bienThe->ton_kho) {
                    $message = 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!';
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $message
                        ], 400);
                    }
                    return redirect()->back()->with('error', $message);
                }

                $gia = $bienThe->gia;

                // Kiểm tra và giảm số lượng Flash Sale nếu có
                $saleEvent = SuKienSanPham::where('id_bien_the_san_pham', $bienThe->id)
                    ->where('hien_thi', 1)
                    ->whereHas('suKien', function ($q) {
                        $q->where('ngay_bat_dau', '<=', now())
                        ->where('ngay_ket_thuc', '>=', now());
                    })->first();

                if ($saleEvent && $saleEvent->so_luong_gioi_han > 0) {
                    $soLuongHienTaiDaBan = ChiTietGioHang::where('id_bien_the', $bienThe->id)
                        ->whereHas('gioHang', function ($q) {
                            $q->where('id_user', Auth::id())->where('loai', 'chinh');
                        })->sum('so_luong');
                    $soLuongConLaiFlashSale = $saleEvent->so_luong_gioi_han - $soLuongHienTaiDaBan;

                    if ($soLuongMuonThem > $soLuongConLaiFlashSale) {
                        $message = 'Số lượng Flash Sale không đủ!';
                        if ($request->ajax()) {
                            return response()->json(['success' => false, 'message' => $message], 400);
                        }
                        return redirect()->back()->with('error', $message);
                    }
                    $gia = $saleEvent->gia_su_kien;
                }
            } else {
                $sanPham = SanPham::findOrFail($request->san_pham_id);
                if ($soLuongMuonThem > $sanPham->so_luong) {
                    $message = 'Số lượng sản phẩm trong kho không đủ hoặc đã hết hàng!';
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => $message
                        ], 400);
                    }
                    return redirect()->back()->with('error', $message);
                }
                $gia = $sanPham->gia ?? 0;
            }

            // Bắt đầu transaction để đảm bảo tính nhất quán
            DB::beginTransaction();
            try {
                // Giảm tồn kho và cập nhật flash sale
                if ($request->bien_the_id) {
                    $bienThe->ton_kho -= $soLuongMuonThem;
                    $bienThe->save();

                    if ($saleEvent && $saleEvent->gia_su_kien == $gia) {
                        $saleEvent->so_luong_gioi_han -= $soLuongMuonThem;
                        $saleEvent->save();
                    }
                } else {
                    $sanPham->so_luong -= $soLuongMuonThem;
                    $sanPham->save();
                }

                // Thêm sản phẩm vào giỏ hàng
                ChiTietGioHang::create([
                    'id_gio_hang' => $gioHang->id,
                    'id_product' => $request->san_pham_id,
                    'id_bien_the' => $request->bien_the_id,
                    'so_luong' => $soLuongMuonThem,
                    'gia' => $gia
                ]);

                                DB::commit();

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
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu không hợp lệ: ' . implode(', ', $e->validator->errors()->all())
                ], 422);
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Buy now error: ' . $e->getMessage(), [
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
                // transaction chỉ thực hiện, dùng return để trả về kết quả
                return DB::transaction(function () use ($request){ # bắt đầu transaction
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

                // Lấy thông tin giỏ hàng.
                $gioHang = GioHang::where('id_user', Auth::id())
                    ->where('loai', 'chinh')
                    ->with([
                        'chiTietGioHangs.sanPham.suKien' => function ($q) {
                        $q->where('su_kien_san_phams.hien_thi', 1)
                        ->where('ngay_ket_thuc', '>=', now())
                        ->orderByDesc('ngay_bat_dau');
                        },
                        'chiTietGioHangs.bienThe.suKien' => function ($q) {
                        $q->where('su_kien_san_phams.hien_thi', 1)
                        ->where('ngay_ket_thuc', '>=', now())
                        ->orderByDesc('ngay_bat_dau');
                        },
                        'maGiamGia'
                    ])
                    ->lockForUpdate() # tránh race condition khi nhiều khác hàng mua cùng lúc
                    ->first();

                if (!$gioHang || $gioHang->chiTietGioHangs->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Giỏ hàng trống!'
                    ], 400);
                }

                // Lấy địa chỉ mặc định của khách hàng.
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

                // Tính tổng tiền
                $tongTienGoc = $gioHang->chiTietGioHangs->map(function ($item) {
                    $giaSuKien = null;
                    if ($item->sanPham && $item->sanPham->suKien->isNotEmpty()) {
                        $suKien = $item->sanPham->suKien->first();
                            if (
                                $suKien->pivot &&
                                $suKien->hien_thi &&
                                $suKien->ngay_bat_dau <= now() &&
                                $suKien->ngay_ket_thuc >= now()
                            ) {
                                $giaSuKien = $suKien->pivot->gia_su_kien;
                            }
                        }
                    $giaThucTe = $giaSuKien ?? $item->gia;
                    return $giaThucTe * $item->so_luong;
                })->sum();

                // Tính toán giảm giá nếu có mã giảm giá
                $giamGia = 0;
                $tongTienSauGiam = $tongTienGoc;

                if ($gioHang->maGiamGia) {
                    $maGiamGia = MaGiamGia::where('id',$gioHang->maGiamGia->id)
                    ->lockForUpdate() # khóa mã giảm giá cho transaction
                    ->first(); # first để lấy bản ghi
                    if ($maGiamGia->so_luong <= 0)
                    {
                        return response()->json(
                            [
                                'success' => false,
                                'message' => 'Mã giảm giá đã hết lượt sử dụng!'
                            ]
                            ,400
                            );
                    }

                    if ($gioHang->maGiamGia->loai === 'phan_tram') {
                        $giamGia = $tongTienGoc * ($gioHang->maGiamGia->gia_tri / 100);
                    } else {
                        $giamGia = $gioHang->maGiamGia->gia_tri;
                    }
                    if (isset($gioHang->maGiamGia->gia_tri_toi_da) && $giamGia > $gioHang->maGiamGia->gia_tri_toi_da) {
                        $giamGia = min($giamGia, $gioHang->maGiamGia->gia_tri_toi_da);
                    }
                    $tongTienSauGiam = max(0, $tongTienGoc - $giamGia);
                    // Trừ số lượng mã giảm giá
                    $maGiamGia->decrement('so_luong');
                    // Kiểm tra số lần user đã sử dụng mã
                    $da_su_dung = MaGiamGiaUser::where('user_id',Auth::id())
                    ->where('ma_giam_gia_id',$maGiamGia->id)
                    ->first();

                    if($da_su_dung)
                    {
                        $da_su_dung->increment('so_lan_su_dung');
                    }else
                    {
                        MaGiamGiaUser::create(
                            [
                                'ma_giam_gia_id' => $maGiamGia->id,
                                'user_id'        => Auth::id(),
                                'so_lan_su_dung' => 1,
                    ]);
                }
                }

                // Tạo đơn hàng.
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

                // Tạo chi tiết đơn hàng.
                foreach ($gioHang->chiTietGioHangs as $item) {
                    $giaSuKien = null;

                    if ($item->sanPham && $item->sanPham->suKien->isNotEmpty()) {
                        $giaSuKien = $item->sanPham->suKien->first()->pivot->gia_su_kien;
                    }
                    $giaThucTe = $giaSuKien ?? $item->gia;

                    $donHang->chiTietDonHangs()->create([
                        'id_product' => $item->id_product,
                        'id_bien_the' => $item->id_bien_the,
                        'ten_hien_thi' => $item->sanPham->ten,
                        'ten_san_pham_tai_thoi_diem' => $item->sanPham->ten,
                        'so_luong' => $item->so_luong,
                        'don_gia' => $giaThucTe,
                        'bao_hanh_thang' => $item->sanPham->bao_hanh_thang
                    ]);
                }
                $customer = User::find(Auth::id());
                $customerLink = route('client.order.success', $donHang->id);
                Mail::to($customer->email)->send(new OrderSuccessMail($donHang, $customer, $customerLink, 'Xem chi tiết đơn hàng'));

                $admins = User::where('vai_tro', 'quan_tri')->where('trang_thai', 'hoat_dong')->get();
                foreach ($admins as $admin) {
                    $adminLink = route('admin.don-hang.show', $donHang->id);
                    Mail::to($admin->email)->send(new OrderSuccessMail($donHang, $admin, $adminLink, 'Xem đơn hàng'));
                }
                // Reset giỏ hàng.
                $gioHang->chiTietGioHangs()->delete();
                $gioHang->id_giam_gia = null;
                $gioHang->save();

                if ($request->payment_method == 2) { // Giả sử ID 2 là phương thức VNPay
                    // Chuẩn bị dữ liệu cho VNPay
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = route('client.vnpay.return');
                    $vnp_TmnCode = "3D6CARP9";
                    $vnp_HashSecret = "VZ4OJHBNFW0TL0DNSY6HFY7P23HKKSDG";

                    $vnp_TxnRef = $donHang->ma_don;
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
                }); # kết thúc transaction
            }
            catch (\Exception $e) {
                Log::error('Place order error: ' . $e->getMessage(), [
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
