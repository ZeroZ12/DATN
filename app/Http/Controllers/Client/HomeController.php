<?php

namespace App\Http\Controllers\Client; // Lưu ý namespace có thể là App\Http\Controllers nếu bạn không dùng Client subfolder

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Chip;
use App\Models\Gpu;
use App\Models\OCung;
use App\Models\Ram;
use App\Models\SanPham;    // Đảm bảo import Model SanPham
use App\Models\ThuongHieu;
use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\BienTheSanPham;
use App\Models\SuKien;
use App\Models\SuKienSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {   
        // Xử lý thêm sản phẩm vào giỏ hàng nếu có parameters
        if ($request->filled('san_pham_id') && $request->filled('so_luong')) {
            return $this->addToCart($request);
        }

        // Get all categories
        $danhMucs = DanhMuc::all();

        // Get products for each category
        $sanphams = SanPham::with([
                'thuongHieu',
                'chip',
                'mainboard',
                'gpu',
                'BienTheSanPhams.ram',
                'BienTheSanPhams.oCung',
            ])
            ->withAvg(['danhGiaSanPhams' => function ($query) {
                $query->where('trang_thai', 'da_duyet');
            }], 'so_sao')
            ->withCount(['danhGiaSanPhams' => function ($query) {
                $query->where('trang_thai', 'da_duyet');
            }])
            ->when($request->filled('id_brand'), fn($q) => $q->where('id_brand', $request->id_brand))
            ->when($request->filled('id_chip'), fn($q) => $q->where('id_chip', $request->id_chip))
            ->when($request->filled('id_gpu'), fn($q) => $q->where('id_gpu', $request->id_gpu))
            ->when(
                $request->filled('id_ram') || $request->filled('id_o_cung'),
                function ($q) use ($request) {
                    $q->whereHas('BienTheSanPhams', function ($sub) use ($request) {
                        if ($request->filled('id_ram')) {
                            $sub->where('id_ram', $request->id_ram);
                        }
                        if ($request->filled('id_o_cung')) {
                            $sub->where('id_o_cung', $request->id_o_cung);
                        }
                    });
                }
            )
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $thuongHieus = ThuongHieu::all();
        $chips = Chip::all();
        $gpus = GPU::all();
        $rams = Ram::all();
        $oCungs = OCung::all();
        $banners = Banner::where('deleted_at', null) // Lọc các banner chưa bị xóa
            ->orderBy('created_at', 'desc')
            ->take(3) // Lấy 3 banner mới nhất
            ->get();
        $r_cates = DanhMuc::orderBy('id', 'desc')->paginate(3);
        $b_cates = DanhMuc::orderBy('id','asc')->paginate(4);
        // $suKien = SuKien::active()->with('sanphams')->get();
        $activeSaleEvents = SuKienSanPham::with('sanPham','bienTheSanPham')
        ->whereHas('suKien', function ($query) {
            $query->where('ngay_bat_dau', '<=', now())
                  ->where('ngay_ket_thuc', '>=', now())
                  ->where('hien_thi', 1);
        })
        ->paginate(9);

    $sanPhamBanChay = SanPham::orderByDesc('luot_mua')
        ->limit(5)
        ->pluck('id')
        ->toArray();

        return view('client.home', compact('activeSaleEvents','sanPhamBanChay','sanphams', 'thuongHieus', 'chips', 'gpus', 'rams', 'oCungs', 'danhMucs', 'banners','r_cates', 'b_cates'));
    }

    public function addToCart(Request $request)
    {
        try {
            // Kiểm tra user đã đăng nhập chưa
            if (!Auth::check()) {
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

            return redirect()->route('client.home')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Cart add error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'id_user' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
        }
    }
}
