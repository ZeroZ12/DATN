<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\YeuCauHoanTra;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\AnhMinhChung;

class YeuCauHoanTraController extends Controller
{
    public function index(Request $request)
    {
        $query = YeuCauHoanTra::with(['donHang', 'donHang.user']);
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }
        $danhSach = $query->latest()->paginate(20);

        $trangThaiHienThi = [
            '' => 'Tất cả',
            'cho_phe_duyet' => 'Chờ phê duyệt',
            'da_phe_duyet' => 'Đã phê duyệt',
            'tu_choi' => 'Từ chối',
            'dang_van_chuyen_tra_hang' => 'Đang trả hàng',
            'da_nhan_hang' => 'Đã nhận hàng',
            'da_hoan_tien' => 'Đã hoàn tiền',
        ];

        return view('admin.donhang.listhoantra', compact('danhSach', 'trangThaiHienThi'));
    }

    public function show($id)
    {
        $hoanTra = YeuCauHoanTra::with([
            'donHang.user',
            'donHang.diaChiNguoiDung',
            'donHang.phuongThucThanhToan',
            'donHang.chiTietDonHangs.bienTheSanPham.sanPham'
        ])->findOrFail($id);
        $adminHoanTra = YeuCauHoanTra::findOrFail($id)->admin_hoan_tra ?? 'admin'; // Lấy tên admin hoặc mặc định là 'admin'
        return view('admin.donhang.showhoantra', compact('hoanTra', 'adminHoanTra'));
    }


public function capNhatTrangThai(Request $request, $id)
{
    $hoanTra = YeuCauHoanTra::with('donHang.chiTietDonHangs.sanPham')->findOrFail($id);

    $hienTai = $request->input('trang_thai_hien_tai');
    $moi = $request->input('trang_thai');

    $allowed = YeuCauHoanTra::TRANG_THAI_FLOW[$hienTai] ?? [];
    if (!in_array($moi, $allowed)) {
        return back()->withErrors(['msg' => 'Không thể cập nhật trạng thái này']);
    }

    $admin = Auth::user();
    $hoanTra->trang_thai = $moi;
    $hoanTra->admin_hoan_tra = $admin->ten_dang_nhap ?? 'admin';

    if ($moi === 'da_nhan_hang') {
        $hoanTra->thoi_gian_nhan_hang = now();
    }

    if ($moi === 'da_hoan_tien') {
        // ✅ Validate bắt buộc có ảnh
        $request->validate([
            'anh_minh_chung' => 'required|array|min:1',
            'anh_minh_chung.*' => 'required|image|max:5120',
        ], [
            'anh_minh_chung.required' => 'Vui lòng chọn ảnh minh chứng hoàn tiền.',
            'anh_minh_chung.*.image' => 'Tất cả file phải là ảnh.',
            'anh_minh_chung.*.max' => 'Ảnh không được lớn hơn 5MB.',
        ]);

        $hoanTra->thoi_gian_hoan_tien = now();
        $hoanTra->id_nguoi_hoan_tien = $admin->id;

        foreach ($request->file('anh_minh_chung') as $file) {
            $path = $file->store('minhchung/anh_hoan_tien', 'public');

            AnhMinhChung::create([
                'id_yeu_cau_hoan_tra' => $hoanTra->id,
                'duong_dan' => $path,
                'loai' => 'admin',
            ]);
        }

        // ✅ Trừ lượt mua khi hoàn tiền thành công
        $donHang = $hoanTra->donHang;

        if (in_array($donHang->trang_thai, ['giao_thanh_cong', 'hoan_thanh'])) {
            foreach ($donHang->chiTietDonHangs as $chiTiet) {
                $sanPham = $chiTiet->sanPham;

                if ($sanPham && $sanPham->luot_mua >= $chiTiet->so_luong) {
                    $sanPham->luot_mua -= $chiTiet->so_luong;
                    $sanPham->save();
                }
            }
        }
    }

    $hoanTra->save();

    return back()->with('success', 'Đã cập nhật trạng thái');
}

}
