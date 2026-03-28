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
    public function index(Request $request)
    {
        $query = DanhGiaSanPham::with(['user', 'sanPham']);

        // Filter by status
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        // Filter by star rating
        if ($request->filled('so_sao')) {
            $query->where('so_sao', $request->so_sao);
        }

        // Filter by product
        if ($request->filled('san_pham')) {
            $query->whereHas('sanPham', function ($q) use ($request) {
                $q->where('ten', 'like', '%' . $request->san_pham . '%');
            });
        }

        // Filter by user
        if ($request->filled('nguoi_dung')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('ho_ten', 'like', '%' . $request->nguoi_dung . '%')
                  ->orWhere('email', 'like', '%' . $request->nguoi_dung . '%');
            });
        }

        // Filter by date range
        if ($request->filled('tu_ngay')) {
            $query->whereDate('created_at', '>=', $request->tu_ngay);
        }
        if ($request->filled('den_ngay')) {
            $query->whereDate('created_at', '<=', $request->den_ngay);
        }

        // Filter by comment content
        if ($request->filled('binh_luan')) {
            $query->where('binh_luan', 'like', '%' . $request->binh_luan . '%');
        }

        // Sort by priority: pending reviews first, then by creation date
        $query->orderByRaw("CASE WHEN trang_thai = 'cho_duyet' THEN 0 ELSE 1 END")
              ->orderByDesc('created_at');

        // Paginate results
        $danhGias = $query->paginate(10)->withQueryString();

        // Get filter options for dropdowns
        $trangThaiOptions = [
            'cho_duyet' => 'Chờ duyệt',
            'da_duyet' => 'Đã duyệt',
            'tu_choi' => 'Từ chối'
        ];

        $soSaoOptions = [
            1 => '1 sao',
            2 => '2 sao',
            3 => '3 sao',
            4 => '4 sao',
            5 => '5 sao'
        ];

        return view('admin.danhgias.index', compact('danhGias', 'trangThaiOptions', 'soSaoOptions'));
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

