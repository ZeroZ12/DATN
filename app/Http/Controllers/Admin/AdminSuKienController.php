<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\SuKien;
use App\Models\BienTheSanPham;
use App\Models\SuKienSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSuKienController extends Controller
{
    public function index()
    {
        $saleEvents = SuKien::with('sanPhams')
            ->orderBy('ngay_bat_dau', 'desc')
            ->paginate(10); // Phân trang để tối ưu
        foreach ($saleEvents as $event) {
            $event->total = $event->sanPhams->sum(function ($sanPham) {
                return $sanPham->pivot->quantity_limit ?? 0; // Tổng số lượng giới hạn của sản phẩm trong sự kiện
            });
        }
        return view('admin.sukien.index', compact('saleEvents'));
    }

    public function create()
    {
        // Chỉ lấy các sản phẩm đang hoạt động (chưa bị xóa mềm).
        $sanphams = SanPham::whereNull('deleted_at')->get();
        $bienThes = BienTheSanPham::with('sanPham')->whereNull('deleted_at')->get();
        return view('admin.sukien.create', compact('sanphams', 'bienThes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_su_kien' => 'required|string|max:255',
            'id_san_pham' => 'nullable|array', 
            'id_san_pham.*' => 'exists:san_phams,id', // Đảm bảo ID sản phẩm tồn tại trong bảng 'san_phams'.
            'id_bien_the_san_pham' => 'nullable|array', // Thêm hỗ trợ cho các biến thể sản phẩm.
            'id_bien_the_san_pham.*' => 'exists:bien_the_san_phams,id', // Đảm bảo ID biến thể tồn tại trong bảng 'bien_the_san_phams'.
            'gia_su_kien' => 'required|array', 
            'gia_su_kien.*' => 'numeric|min:0', 
            'ngay_bat_dau' => 'required|date|after_or_equal:today', 
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau', 
            'quantity_limit' => 'nullable|array', // Giới hạn số lượng là tùy chọn và là một mảng.
            'quantity_limit.*' => [
            'nullable',
            'integer',
            'min:0',
            function ($attribute, $value, $fail) use ($request) {
                // Lấy index của quantity_limit (ví dụ: quantity_limit[123] hoặc quantity_limit[bien_the_456])
                $index = explode('.', $attribute)[1];
                if (str_starts_with($index, 'bien_the_')) {
                    // Xử lý biến thể
                    $bienTheId = str_replace('bien_the_', '', $index);
                    $bienThe = BienTheSanPham::find($bienTheId);
                    if ($bienThe && $value > $bienThe->so_luong) {
                        $fail("Giới hạn số lượng của biến thể {$bienThe->ma_bien_the} không được vượt quá số lượng tồn kho ({$bienThe->so_luong}).");
                    }
                } else {
                    // Xử lý sản phẩm
                    $sanPham = SanPham::find($index);
                    if ($sanPham && $value > $sanPham->so_luong) {
                        $fail("Giới hạn số lượng của sản phẩm {$sanPham->ten} không được vượt quá số lượng tồn kho ({$sanPham->so_luong}).");
                    }
                }
            },
        ], 
        ]);

        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch cơ sở dữ liệu.

            $suKien = SuKien::create([
                'ten_su_kien' => $request->ten_su_kien,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
            ]);

            // Kết hợp ID sản phẩm và biến thể thành một mảng duy nhất để xử lý.
            // $giaSuKienData = $request->input('gia_su_kien', []);
            // $quantityLimitData = $request->input('quantity_limit', []);

            // Xóa các liên kết hiện tại
            $suKien->sanPhams()->detach();
            $suKien->bienTheSanPhams()->detach();

            // Gắn sản phẩm
            $giaSuKienData = $request->input('gia_su_kien', []);
            $quantityLimitData = $request->input('quantity_limit', []);

            // Gắn từng sản phẩm hoặc biến thể vào sự kiện trong bảng trung gian.
            foreach ($request->id_san_pham ?? [] as $sanPhamId) {
                $sanPham = SanPham::find($sanPhamId);
                    if ($sanPham) {
                    $suKien->sanPhams()->attach(
                            $sanPhamId,
                            [
                                'id_san_pham' => $sanPhamId,
                                'id_bien_the_san_pham' => null,
                                'gia_su_kien' => $giaSuKienData[$sanPhamId] ?? null,
                                'gia_goc' => $sanPham->gia,
                                'quantity_limit' => $quantityLimitData[$sanPhamId] ?? null,
                            ]
                    );
                }
            }

            foreach ($request->id_bien_the_san_pham ?? [] as $bienTheId) {
                $bienThe = BienTheSanPham::with('sanPham')->find($bienTheId);
                    if ($bienThe) {
                        $key = 'bien_the_' . $bienTheId;
                        $suKien->bienTheSanPhams()->attach(
                            $bienTheId,
                            [
                                'id_san_pham' => $bienThe->san_pham_id,
                                'id_bien_the_san_pham' => $bienTheId,
                                'gia_su_kien' => $giaSuKienData[$key] ?? null,
                                'gia_goc' => $bienThe->gia,
                                'quantity_limit' => $quantityLimitData[$key] ?? null,
                            ]
                    );
                }
            }


            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch nếu có lỗi.
            return redirect()->back()->withInput()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // Tìm sự kiện theo ID và tải các sản phẩm liên quan.
        $suKien = SuKien::with('sanPhams','bienTheSanPhams','ChiTietSuKien')->findOrFail($id);
        $sanphams = SanPham::whereNull('deleted_at')->get();
        $bienThes = BienTheSanPham::with('sanPham')->whereNull('deleted_at')->get();
        return view('admin.sukien.edit', compact('suKien', 'sanphams', 'bienThes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_su_kien' => 'required|string|max:255',
            'id_san_pham' => 'nullable|array', 
            'id_san_pham.*' => 'exists:san_phams,id', // Đảm bảo ID sản phẩm tồn tại trong bảng 'san_phams'.
            'id_bien_the_san_pham' => 'nullable|array', // Thêm hỗ trợ cho các biến thể sản phẩm.
            'id_bien_the_san_pham.*' => 'exists:bien_the_san_phams,id', // Đảm bảo ID biến thể tồn tại trong bảng 'bien_the_san_phams'.
            'gia_su_kien' => 'required|array', 
            'gia_su_kien.*' => 'numeric|min:0', 
            'ngay_bat_dau' => 'required|date|after_or_equal:today', 
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau', 
            'quantity_limit' => 'nullable|array', 
            'quantity_limit.*' => [
            'nullable',
            'integer',
            'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    // Lấy index của quantity_limit (ví dụ: quantity_limit[123] hoặc quantity_limit[bien_the_456])
                    $index = explode('.', $attribute)[1];
                    if (str_starts_with($index, 'bien_the_')) {
                        // Xử lý biến thể
                        $bienTheId = str_replace('bien_the_', '', $index);
                        $bienThe = BienTheSanPham::find($bienTheId);
                        if ($bienThe && $value > $bienThe->so_luong) {
                            $fail("Giới hạn số lượng của biến thể {$bienThe->ma_bien_the} không được vượt quá số lượng tồn kho ({$bienThe->so_luong}).");
                        }
                    } else {
                        // Xử lý sản phẩm
                        $sanPham = SanPham::find($index);
                        if ($sanPham && $value > $sanPham->so_luong) {
                            $fail("Giới hạn số lượng của sản phẩm {$sanPham->ten} không được vượt quá số lượng tồn kho ({$sanPham->so_luong}).");
                        }
                    }
                },
            ], 
        ]);

        try {
            DB::beginTransaction(); 

            $suKien = SuKien::findOrFail($id); 
            $suKien->update([
                'ten_su_kien' => $request->ten_su_kien,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
            ]);

            $suKien->sanPhams()->detach();
            $suKien->bienTheSanPhams()->detach(); // Xóa tất cả các liên kết hiện tại trong bảng trung gian.

            // Kết hợp ID sản phẩm và biến thể thành một mảng duy nhất để xử lý.
            $giaSuKienData = $request->input('gia_su_kien', []);
            $quantityLimitData = $request->input('quantity_limit', []);

            // Gắn từng sản phẩm hoặc biến thể vào sự kiện trong bảng trung gian.
            foreach ($request->id_san_pham ?? [] as $sanPhamId) {
                $sanPham = SanPham::find($sanPhamId);
                if ($sanPham) {
                    $suKien->sanPhams()->attach(
                        $sanPhamId,
                        [
                            'id_san_pham' => $sanPhamId,
                            'id_bien_the_san_pham' => null, // Không có biến thể
                            'gia_su_kien' => $giaSuKienData[$sanPhamId] ?? null, // Truy cập bằng khóa là ID sản phẩm
                            'gia_goc' => $sanPham->gia,
                            'quantity_limit' => $quantityLimitData[$sanPhamId] ?? null, // Truy cập bằng khóa là ID sản phẩm
                        ]
                    );
                }
            }

            foreach ($request->id_bien_the_san_pham ?? [] as $bienTheId) {
                $bienThe = BienTheSanPham::with('sanPham')->find($bienTheId);
                if ($bienThe) {
                    $key = 'bien_the_' . $bienTheId; // Tạo khóa tương ứng với tên input trong Blade
                    $suKien->bienTheSanPhams()->attach(
                        $bienTheId, // Gắn vào id_product của biến thể
                        [
                            'id_san_pham' => $bienThe->san_pham_id,
                            'id_bien_the_san_pham' => $bienTheId,
                            'gia_su_kien' => $giaSuKienData[$key] ?? null, // Truy cập bằng khóa là 'bien_the_' + ID biến thể
                            'gia_goc' => $bienThe->gia, // Giá gốc của biến thể
                            'quantity_limit' => $quantityLimitData[$key] ?? null, // Truy cập bằng khóa là 'bien_the_' + ID biến thể
                        ]
                    );
                }
            }


            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch nếu có lỗi.
            return redirect()->back()->withInput()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        // Hiển thị chi tiết sự kiện.
        $suKien = SuKien::findOrFail($id);
        return view('admin.sukien.show', compact('suKien'));
    }   

    public function destroy($id)
    {
        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch.
            $suKien = SuKien::findOrFail($id); // Tìm sự kiện.
            $suKien->sanPhams()->detach(); // Xóa tất cả các liên kết trong bảng trung gian.
            $suKien->delete(); // Thực hiện xóa mềm sự kiện (soft delete).
            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được xóa tạm thời.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch.
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    public function trashed()
    {
        // Hiển thị danh sách các sự kiện đã bị xóa mềm (trong thùng rác).
        $trashedSuKiens = SuKien::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.sukien.trash', compact('trashedSuKiens'));
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch.
            $suKien = SuKien::onlyTrashed()->findOrFail($id); // Tìm sự kiện đã xóa mềm.
            $suKien->restore(); // Khôi phục sự kiện.
            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.index')->with('success', 'Khôi phục sự kiện thành công.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch.
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch.
            $suKien = SuKien::withTrashed()->findOrFail($id); // Tìm sự kiện (kể cả đã xóa mềm).
            $suKien->sanPhams()->detach(); // Xóa tất cả các liên kết trong bảng trung gian.
            $suKien->forceDelete(); // Xóa vĩnh viễn sự kiện khỏi cơ sở dữ liệu.
            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.trash')->with('success', 'Sự kiện đã được xóa vĩnh viễn.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch.
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}