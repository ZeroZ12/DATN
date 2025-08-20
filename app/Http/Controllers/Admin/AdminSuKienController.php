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
        $saleEvents = SuKien::with('sanPhams','bienTheSanPhams')
            ->orderBy('ngay_bat_dau', 'desc')
            ->paginate(10); // Phân trang để tối ưu
        foreach ($saleEvents as $event) {
            $totalSP = $event->sanPhams->sum(function ($sanPham) {
                return $sanPham->pivot->so_luong_gioi_han ?? 0; // Tổng số lượng giới hạn của sản phẩm trong sự kiện
            });
            $totalBienThe = $event->bienTheSanPhams->sum(function ($bienThe) {
                return $bienThe->pivot->so_luong_gioi_han ?? 0; // Tổng số lượng giới hạn của biến thể trong sự kiện
            });
            $event->total = $totalSP + $totalBienThe; // Tổng số lượng giới hạn của cả sản phẩm và biến thể
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
            'id_san_pham' => 'nullable|array|min:1', 
            'id_san_pham.*' => 'exists:san_phams,id', 
            'id_bien_the_san_pham' => 'nullable|array|min:1', 
            'id_bien_the_san_pham.*' => 'exists:bien_the_san_phams,id', 
            'gia_su_kien' => 'required|array', 
            'gia_su_kien.*' => 'numeric|min:0', 
            'ngay_bat_dau' => 'required|date|after_or_equal:today', 
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau', 
            'so_luong_gioi_han' => 'nullable|array', 
            'so_luong_gioi_han.*' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    if (str_starts_with($index, 'bien_the_')) {
                        $bienTheId = str_replace('bien_the_', '', $index);
                        $bienThe = BienTheSanPham::find($bienTheId);
                        if ($bienThe && $value > $bienThe->ton_kho) {
                            $fail("Giới hạn số lượng của biến thể {$bienThe->ma_bien_the} không được vượt quá số lượng tồn kho ({$bienThe->so_luong}).");
                        }
                    } else {
                        $sanPham = SanPham::find($index);
                        if ($sanPham && $value > $sanPham->so_luong) {
                            $fail("Giới hạn số lượng của sản phẩm {$sanPham->ten} không được vượt quá số lượng tồn kho ({$sanPham->so_luong}).");
                        }
                    }
                },
            ], 
        ], [
            'ten_su_kien.required' => 'Tên sự kiện không được để trống.',
            'ten_su_kien.string' => 'Tên sự kiện phải là chuỗi ký tự.',
            'ten_su_kien.max' => 'Tên sự kiện không được vượt quá 255 ký tự.',
            'ngay_bat_dau.required' => 'Ngày bắt đầu không được để trống.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu phải là ngày hôm nay hoặc sau đó.',
            'ngay_ket_thuc.required' => 'Ngày kết thúc không được để trống.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'id_san_pham.array' => 'ID sản phẩm phải là một mảng.',
            'id_san_pham.min' => 'Ít nhất một sản phẩm phải được chọn.',
            'id_san_pham.*.exists' => 'Một hoặc nhiều ID sản phẩm không tồn tại.',
            'id_bien_the_san_pham.array' => 'ID biến thể sản phẩm phải là một mảng.',
            'id_bien_the_san_pham.min' => 'Ít nhất một biến thể sản phẩm phải được chọn.',
            'id_bien_the_san_pham.*.exists' => 'Một hoặc nhiều ID biến thể sản phẩm không tồn tại.',
            'gia_su_kien.required' => 'Giá sự kiện không được để trống.',
            'gia_su_kien.array' => 'Giá sự kiện phải là một mảng.',
            'gia_su_kien.*.numeric' => 'Giá sự kiện phải là một số.',
            'so_luong_gioi_han.array' => 'Giới hạn số lượng phải là một mảng.',
            'so_luong_gioi_han.*.integer' => 'Giới hạn số lượng phải là một số nguyên.',
            'so_luong_gioi_han.*.min' => 'Giới hạn số lượng phải lớn hơn hoặc bằng 0.',
            'so_luong_gioi_han.*.nullable' => 'Giới hạn số lượng có thể để trống.',
        ]);

        try {
            DB::beginTransaction();

            $suKien = SuKien::create([
                'ten_su_kien' => $request->ten_su_kien,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
                'hien_thi' => 1,
            ]);

            $suKien->sanPhams()->detach();
            $suKien->bienTheSanPhams()->detach();

            $giaSuKienData = $request->input('gia_su_kien', []);
            $soLuongGioiHanData = $request->input('so_luong_gioi_han', []);

            foreach ($request->id_san_pham ?? [] as $sanPhamId) {
                $sanPham = SanPham::find($sanPhamId);
                if ($sanPham) {
                    $giaSuKien = $giaSuKienData[$sanPhamId] ?? null;
                    $giaGoc = $sanPham->gia ?? 0;
                    $soLuongGioiHan = $soLuongGioiHanData[$sanPhamId] ?? null;
                    $giaGocSKBD = $giaGoc > 0 ? $giaGoc : ($giaSuKien ?? 1);
                    $suKien->sanPhams()->attach(
                        $sanPhamId,
                        [
                            'id_san_pham' => $sanPhamId,
                            'id_bien_the_san_pham' => null,
                            'gia_su_kien' => $giaSuKien,
                            'gia_goc' => $sanPham->gia,
                            'gia_goc_khi_bat_dau' => $giaGocSKBD,
                            'so_luong_gioi_han' => $soLuongGioiHan,
                        ]
                    );
                }
            }

            foreach ($request->id_bien_the_san_pham ?? [] as $bienTheId) {
                $bienThe = BienTheSanPham::with('sanPham')->find($bienTheId);
                if ($bienThe) {
                    $key = 'bien_the_' . $bienTheId;
                    $giaSuKien = $giaSuKienData[$key] ?? null;
                    $giaGoc = $bienThe->gia ?? 0;
                    $soLuongGioiHan = $soLuongGioiHanData[$key] ?? null;
                    $giaGocSKBD = $giaGoc > 0 ? $giaGoc : ($giaSuKien ?? 1);
                    $suKien->bienTheSanPhams()->attach(
                        $bienTheId,
                        [
                            'id_san_pham' => $bienThe->san_pham_id,
                            'id_bien_the_san_pham' => $bienTheId,
                            'gia_su_kien' => $giaSuKien,
                            'gia_goc' => $giaGoc,
                            'gia_goc_khi_bat_dau' => $giaGocSKBD,
                            'so_luong_gioi_han' => $soLuongGioiHan,
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
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
            'id_san_pham' => 'nullable|array|min:1', 
            'id_san_pham.*' => 'exists:san_phams,id', 
            'id_bien_the_san_pham' => 'nullable|array|min:1', 
            'id_bien_the_san_pham.*' => 'exists:bien_the_san_phams,id', 
            'gia_su_kien' => 'required|array', 
            'gia_su_kien.*' => 'numeric|min:0', 
            // 'ngay_bat_dau' => 'required|date|after_or_equal:today', 
            'ngay_bat_dau' => 'required|date', 
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau', 
            'so_luong_gioi_han' => 'nullable|array', 
            'so_luong_gioi_han.*' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    if (str_starts_with($index, 'bien_the_')) {
                        $bienTheId = str_replace('bien_the_', '', $index);
                        $bienThe = BienTheSanPham::find($bienTheId);
                        if ($bienThe && $value > $bienThe->ton_kho) {
                            $fail("Giới hạn số lượng của biến thể {$bienThe->ma_bien_the} không được vượt quá số lượng tồn kho ({$bienThe->so_luong}).");
                        }
                    } else {
                        $sanPham = SanPham::find($index);
                        if ($sanPham && $value > $sanPham->so_luong) {
                            $fail("Giới hạn số lượng của sản phẩm {$sanPham->ten} không được vượt quá số lượng tồn kho ({$sanPham->so_luong}).");
                        }
                    }
                },
            ], 
        ], [
            'ten_su_kien.required' => 'Tên sự kiện không được để trống.',
            'ten_su_kien.string' => 'Tên sự kiện phải là chuỗi ký tự.',
            'ten_su_kien.max' => 'Tên sự kiện không được vượt quá 255 ký tự.',
            'ngay_bat_dau.required' => 'Ngày bắt đầu không được để trống.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            // 'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu phải là ngày hôm nay hoặc sau đó.',
            'ngay_ket_thuc.required' => 'Ngày kết thúc không được để trống.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'ngay_ket_thuc.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'id_san_pham.array' => 'ID sản phẩm phải là một mảng.',
            'id_san_pham.min' => 'Ít nhất một sản phẩm phải được chọn.',
            'id_san_pham.*.exists' => 'Một hoặc nhiều ID sản phẩm không tồn tại.',
            'id_bien_the_san_pham.array' => 'ID biến thể sản phẩm phải là một mảng.',
            'id_bien_the_san_pham.min' => 'Ít nhất một biến thể sản phẩm phải được chọn.',
            'id_bien_the_san_pham.*.exists' => 'Một hoặc nhiều ID biến thể sản phẩm không tồn tại.',
            'gia_su_kien.required' => 'Giá sự kiện không được để trống.',
            'gia_su_kien.array' => 'Giá sự kiện phải là một mảng.',
            'gia_su_kien.*.numeric' => 'Giá sự kiện phải là một số.',
            'so_luong_gioi_han.array' => 'Giới hạn số lượng phải là một mảng.',
            'so_luong_gioi_han.*.integer' => 'Giới hạn số lượng phải là một số nguyên.',
            'so_luong_gioi_han.*.min' => 'Giới hạn số lượng phải lớn hơn hoặc bằng 0.',
            'so_luong_gioi_han.*.nullable' => 'Giới hạn số lượng có thể để trống.',
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
            $suKien->bienTheSanPhams()->detach();

            $giaSuKienData = $request->input('gia_su_kien', []);
            $soLuongGioiHanData = $request->input('so_luong_gioi_han', []);

            foreach ($request->id_san_pham ?? [] as $sanPhamId) {
                $sanPham = SanPham::find($sanPhamId);
                if ($sanPham) {
                    $giaSuKien = $giaSuKienData[$sanPhamId] ?? null;
                    $giaGoc = $sanPham->gia ?? 0;
                    $soLuongGioiHan = $soLuongGioiHanData[$sanPhamId] ?? null;
                    $giaGocSKBD = $giaGoc > 0 ? $giaGoc : ($giaSuKien ?? 1);
                    $suKien->sanPhams()->attach(
                        $sanPhamId,
                        [
                            'id_san_pham' => $sanPhamId,
                            'id_bien_the_san_pham' => null,
                            'gia_su_kien' => $giaSuKien,
                            'gia_goc' => $sanPham->gia,
                            'gia_goc_khi_bat_dau' => $giaGocSKBD,
                            'so_luong_gioi_han' => $soLuongGioiHan,
                        ]
                    );
                }
            }

            foreach ($request->id_bien_the_san_pham ?? [] as $bienTheId) {
                $bienThe = BienTheSanPham::with('sanPham')->find($bienTheId);
                if ($bienThe) {
                    $key = 'bien_the_' . $bienTheId;
                    $giaSuKien = $giaSuKienData[$key] ?? null;
                    $giaGoc = $bienThe->gia ?? 0;
                    $soLuongGioiHan = $soLuongGioiHanData[$key] ?? null;
                    $giaGocSKBD = $giaGoc > 0 ? $giaGoc : ($giaSuKien ?? 1);
                    $suKien->bienTheSanPhams()->attach(
                        $bienTheId,
                        [
                            'id_san_pham' => $bienThe->san_pham_id,
                            'id_bien_the_san_pham' => $bienTheId,
                            'gia_su_kien' => $giaSuKien,
                            'gia_goc' => $giaGoc,
                            'gia_goc_khi_bat_dau' => $giaGocSKBD,
                            'so_luong_gioi_han' => $soLuongGioiHan,
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được cập nhật thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function toggleDisplay($id)
    {
        try {
            DB::beginTransaction();
            $suKien = SuKien::findOrFail($id);
            $suKien->hien_thi = $suKien->hien_thi == 1 ? 0 : 1; // Chuyển đổi trạng thái
            $suKien->save();
            DB::commit();
            return redirect()->route('admin.sukien.index')->with('success', 'Trạng thái sự kiện đã được cập nhật.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}