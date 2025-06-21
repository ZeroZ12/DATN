<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhGiaSanPham;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả đánh giá, eager load mối quan hệ user và sanPham
        // Sắp xếp để đánh giá mới nhất hoặc "chờ duyệt" lên đầu
        $danhGias = DanhGiaSanPham::with(['user', 'sanPham'])
            ->orderByRaw("CASE WHEN trang_thai = 'cho_duyet' THEN 0 ELSE 1 END") // Ưu tiên chờ duyệt
            ->orderByDesc('created_at')
            ->paginate(10); // Phân trang

        return view('admin.danhgias.index', compact('danhGias'));
    }

    /**
     * Show the form for creating a new resource. (Không cần cho admin)
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. (Không cần cho admin)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhGiaSanPham $danhGia)
    {
        // Laravel tự động tìm DanhGiaSanPham dựa trên {danhgia} trong route (Route Model Binding).
        // Tuy nhiên, để đảm bảo các mối quan hệ được tải, nên eager load nếu cần hiển thị.
        // Dù index đã load, nhưng khi truy cập trực tiếp bằng show, nó có thể chưa load.
        $danhGia->loadMissing(['user', 'sanPham']); // Tải các mối quan hệ nếu chưa được tải

        return view('admin.danhgias.show', compact('danhGia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhGiaSanPham $danhGia)
    {
        // Tương tự như show, đảm bảo các mối quan hệ được tải nếu cần hiển thị trong form edit.
        $danhGia->loadMissing(['user', 'sanPham']); // Tải các mối quan hệ nếu chưa được tải

        return view('admin.danhgias.edit', compact('danhGia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DanhGiaSanPham $danhGia)
    {
        // Validation cơ bản cho việc cập nhật bởi admin
        $request->validate([
            'so_sao' => ['required', 'integer', 'min:1', 'max:5'],
            'binh_luan' => ['nullable', 'string', 'max:1000'],
            'trang_thai' => ['required', 'string', 'in:cho_duyet,da_duyet,tu_choi'],
        ]);

        $danhGia->update([
            'so_sao' => $request->so_sao,
            'binh_luan' => $request->binh_luan,
            'trang_thai' => $request->trang_thai,
        ]);

        return redirect()->route('admin.danhgias.index')->with('success', 'Đánh giá đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhGiaSanPham $danhGia)
    {
        $danhGia->delete(); // Sử dụng soft delete (do Model có SoftDeletes trait)

        return redirect()->route('admin.danhgias.index')->with('success', 'Đánh giá đã được xóa thành công!');
    }

    /**
     * Phương thức duyệt đánh giá nhanh
     */
    public function approve(DanhGiaSanPham $danhGia)
    {
        $danhGia->update(['trang_thai' => 'da_duyet']);
        return redirect()->back()->with('success', 'Đánh giá đã được duyệt.');
    }

    /**
     * Phương thức từ chối đánh giá nhanh
     */
    public function reject(DanhGiaSanPham $danhGia)
    {
        $danhGia->update(['trang_thai' => 'tu_choi']);
        return redirect()->back()->with('success', 'Đánh giá đã bị từ chối.');
    }
}
