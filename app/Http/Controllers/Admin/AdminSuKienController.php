<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\SuKien;
use App\Models\BienTheSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSuKienController extends Controller
{
    public function index()
    {
        // Lấy tất cả sự kiện bán hàng cùng với các sản phẩm liên quan, sắp xếp theo ngày bắt đầu giảm dần và phân trang.
        $saleEvents = SuKien::with('sanPhams')
            ->orderBy('ngay_bat_dau', 'desc')
            ->paginate(10); // Phân trang để tối ưu
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
        // Xác thực dữ liệu đầu vào từ yêu cầu.
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
            'quantity_limit.*' => 'nullable|integer|min:0', 
        ]);

        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch cơ sở dữ liệu.

            $suKien = SuKien::create([
                'ten_su_kien' => $request->ten_su_kien,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
            ]);

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
                    $suKien->sanPhams()->attach(
                        $bienThe->id_product, // Gắn vào id_product của biến thể
                        [
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

    public function edit($id)
    {
        // Tìm sự kiện theo ID và tải các sản phẩm liên quan.
        $suKien = SuKien::with('sanPhams')->findOrFail($id);
        // Lấy tất cả sản phẩm và biến thể đang hoạt động để hiển thị trên form chỉnh sửa.
        $sanphams = SanPham::whereNull('deleted_at')->get();
        $bienThes = BienTheSanPham::with('sanPham')->whereNull('deleted_at')->get();
        return view('admin.sukien.edit', compact('suKien', 'sanphams', 'bienThes'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào tương tự như khi tạo.
        $request->validate([
            'ten_su_kien' => 'required|string|max:255',
            'id_san_pham' => 'nullable|array',
            'id_san_pham.*' => 'exists:san_phams,id',
            'id_bien_the_san_pham' => 'nullable|array',
            'id_bien_the_san_pham.*' => 'exists:bien_the_san_phams,id',
            'gia_su_kien' => 'required|array',
            'gia_su_kien.*' => 'numeric|min:0',
            'ngay_bat_dau' => 'required|date|after_or_equal:today',
            'ngay_ket_thuc' => 'required|date|after:ngay_bat_dau',
            'quantity_limit' => 'nullable|array',
            'quantity_limit.*' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction(); // Bắt đầu một giao dịch.

            $suKien = SuKien::findOrFail($id); // Tìm sự kiện cần cập nhật.
            $suKien->update([ // Cập nhật thông tin cơ bản của sự kiện.
                'ten_su_kien' => $request->ten_su_kien,
                'ngay_bat_dau' => $request->ngay_bat_dau,
                'ngay_ket_thuc' => $request->ngay_ket_thuc,
            ]);

            // Bước 1: Detach (gỡ bỏ) tất cả các liên kết hiện có trong bảng trung gian.
            $suKien->sanPhams()->detach();

            // Bước 2: Gắn lại (attach) tất cả các sản phẩm/biến thể mới từ request.
            $items = array_merge(
                array_map(function ($id) { return ['type' => 'san_pham', 'id' => $id]; }, $request->id_san_pham ?? []),
                array_map(function ($id) { return ['type' => 'bien_the', 'id' => $id]; }, $request->id_bien_the_san_pham ?? [])
            );

            foreach ($items as $index => $item) {
                $model = $item['type'] === 'san_pham'
                    ? SanPham::find($item['id'])
                    : BienTheSanPham::find($item['id']);
                if ($model) {
                    $suKien->sanPhams()->attach(
                        $item['type'] === 'san_pham' ? $item['id'] : $model->id_product,
                        [
                            'id_bien_the' => $item['type'] === 'bien_the' ? $item['id'] : null,
                            'gia_su_kien' => $request->gia_su_kien[$index],
                            'gia_goc' => $item['type'] === 'san_pham' ? $model->gia : $model->gia,
                            'quantity_limit' => $request->quantity_limit[$index] ?? null,
                        ]
                    );
                }
            }

            DB::commit(); // Hoàn thành giao dịch.
            return redirect()->route('admin.sukien.index')->with('success', 'Sự kiện đã được cập nhật thành công.');
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác giao dịch nếu có lỗi.
            return redirect()->back()->withInput()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
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

    public function trash()
    {
        // Hiển thị danh sách các sự kiện đã bị xóa mềm (trong thùng rác).
        $trashedSuKiens = SuKien::onlyTrashed()->paginate(10);
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