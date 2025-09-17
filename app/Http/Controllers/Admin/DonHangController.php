<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
use App\Models\AnhMinhChung;
use Illuminate\Http\Request;
use App\Models\YeuCauHoanTra;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with(['user', 'diaChiNguoiDung'])->orderByDesc('created_at');

        if ($request->trang_thai === 'hoan_tra') {
            $query->whereHas('yeuCauHoanTra');
        } elseif ($request->trang_thai) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $donHangs = $query->paginate(20);

        return view('admin.donhang.index', compact('donHangs'));
    }


    public function show($id)
    {
        $donHang = DonHang::with([
            'user',
            'diaChiNguoiDung',
            'phuongThucThanhToan',
            'maGiamGia',
            'chiTietDonHangs.bienTheSanPham.sanPham'
        ])->findOrFail($id);

        return view('admin.donhang.show', compact('donHang'));
    }

    // public function capNhatTrangThai(Request $request, $id)
    // {
    //     $request->validate([
    //         'trang_thai' => 'required|in:' . implode(',', DonHang::TRANG_THAI),
    //         'trang_thai_hien_tai' => 'required|string',
    //     ]);

    //     $donHang = DonHang::findOrFail($id);

    //     if ($donHang->trang_thai !== $request->trang_thai_hien_tai) {
    //         return redirect()->back()->with('error', 'Trạng thái đơn hàng đã thay đổi. Vui lòng tải lại trang.');
    //     }

    //     if ($request->trang_thai === 'da_huy') {
    //         $donHang->update([
    //             'trang_thai' => 'da_huy',
    //             'huy_boi' => 'admin',
    //         ]);
    //     } else {
    //         $donHang->update([
    //             'trang_thai' => $request->trang_thai,
    //         ]);
    //     }

    //   return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');

    // }

public function capNhatTrangThai(Request $request, $id)
{
    $donHang = DonHang::with('chiTietDonHangs.sanPham')->findOrFail($id);

    // Nếu là hoàn tiền thì validate ảnh
    if ($request->trang_thai === 'da_hoan_tien') {
        $request->validate([
            'anh_minh_chung'   => 'required|array|min:1',
            'anh_minh_chung.*' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ], [
            'anh_minh_chung.required' => 'Vui lòng chọn ít nhất 1 ảnh minh chứng.',
            'anh_minh_chung.array'    => 'Ảnh minh chứng không hợp lệ.',
            'anh_minh_chung.min'      => 'Phải tải lên ít nhất 1 ảnh minh chứng.',
            'anh_minh_chung.*.image'  => 'Tệp tải lên phải là hình ảnh.',
            'anh_minh_chung.*.mimes'  => 'Ảnh minh chứng phải có định dạng: jpg, jpeg, png, gif, webp.',
            'anh_minh_chung.*.max'    => 'Kích thước ảnh tối đa 2MB.',
        ]);
    }

    $request->validate([
        'trang_thai'          => 'required|in:' . implode(',', DonHang::TRANG_THAI),
        'trang_thai_hien_tai' => 'required|string',
    ], [
        'trang_thai.required'          => 'Trạng thái đơn hàng là bắt buộc.',
        'trang_thai.in'                => 'Trạng thái đơn hàng không hợp lệ.',
        'trang_thai_hien_tai.required' => 'Thiếu trạng thái hiện tại của đơn hàng.',
    ]);

    if ($donHang->trang_thai !== $request->trang_thai_hien_tai) {
        return redirect()->back()->with('error', 'Trạng thái đơn hàng đã thay đổi. Vui lòng tải lại trang.');
    }

    $trangThaiCu  = $donHang->trang_thai;
    $trangThaiMoi = $request->trang_thai;

    // ✅ Hủy đơn
    if ($trangThaiMoi === 'da_huy') {
        foreach ($donHang->chiTietDonHangs as $chiTiet) {
            $bienThe = $chiTiet->bienTheSanPham;
            if ($bienThe) {
                $bienThe->ton_kho += $chiTiet->so_luong;
                $bienThe->save();
            } elseif ($chiTiet->sanPham) {
                $chiTiet->sanPham->increment('so_luong', $chiTiet->so_luong);
            }
        }
        $donHang->update([
            'trang_thai' => 'da_huy',
            'huy_boi'    => 'admin',
        ]);
    }

    // ✅ Các trạng thái khác
    else {
        $donHang->update(['trang_thai' => $trangThaiMoi]);

        if ($trangThaiMoi === 'dang_giao_hang') {
            $donHang->update(['trang_thai_vc_giao_hang' => 'dang_giao']);
        } elseif ($trangThaiMoi === 'giao_thanh_cong') {
            $donHang->update(['trang_thai_vc_giao_hang' => 'da_giao']);
        } elseif ($trangThaiMoi === 'shop_da_nhan_hang') {
            $donHang->update([
                'trang_thai_vc_hoan'  => 'da_giao',
                'thoi_gian_shop_nhan' => now(),
            ]);
        }
    }

    // ✅ Cộng lượt mua
    if ($trangThaiMoi === 'giao_thanh_cong' && !in_array($trangThaiCu, ['giao_thanh_cong', 'hoan_thanh'])) {
        $coYeuCauHoanTra = YeuCauHoanTra::where('id_don_hang', $donHang->id)->exists();
        if (!$coYeuCauHoanTra) {
            foreach ($donHang->chiTietDonHangs as $chiTiet) {
                if ($chiTiet->sanPham) {
                    $chiTiet->sanPham->increment('luot_mua', $chiTiet->so_luong);
                }
            }
        }
    }

    // ✅ Từ chối hoàn
    if ($trangThaiMoi === 'tu_choi_hoan') {
        $donHang->update([
            'trang_thai'    => 'hoan_thanh',
            'tu_choi_hoan'  => 1,
        ]);
    }

    // ✅ Hoàn tiền (Admin)
    if ($trangThaiMoi === 'da_hoan_tien') {
        if ($request->hasFile('anh_minh_chung')) {
            foreach ($request->file('anh_minh_chung') as $file) {
                $path = $file->store('refunds', 'public');
                AnhMinhChung::create([
                    'id_don_hang' => $donHang->id,
                    'duong_dan'   => $path,
                    'loai'        => 'admin',
                ]);
            }
        }

        $donHang->update([
            'trang_thai'          => 'da_huy',
            'huy_boi'             => 'he_thong',
            'id_nguoi_hoan_tien'  => Auth::id(),
            'thoi_gian_hoan_tien' => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
}



    public function revenueList(Request $request)
    {
        $query = DonHang::with(['user', 'diaChiNguoiDung', 'phuongThucThanhToan', 'chiTietDonHangs.sanPham', 'chiTietDonHangs.bienTheSanPham', 'yeuCauHoanTra']);
        $query->where('trang_thai', 'hoan_thanh');
        $filterType = $request->input('filter_type', 'day');
        if ($filterType === 'range' && $request->filled(['from', 'to'])) {
            $from = $request->input('from');
            $to = $request->input('to');
            $query->whereDate('updated_at', '>=', $from)->whereDate('updated_at', '<=', $to);
        } elseif ($filterType === 'day' && $request->filled('day')) {
            $day = $request->input('day');
            $query->whereDate('updated_at', $day);
        } elseif ($filterType === 'month' && $request->filled('month')) {
            $month = $request->input('month');
            $parts = explode('-', $month);
            if (count($parts) === 2) {
                $query->whereMonth('updated_at', $parts[1])->whereYear('updated_at', $parts[0]);
            }
        } elseif ($filterType === 'year' && $request->filled('year')) {
            $year = $request->input('year');
            $query->whereYear('updated_at', $year);
        }
        $donHangs = $query->orderByDesc('updated_at')->paginate(20);
        return view('admin.donhang.index', compact('donHangs'));
    }


}
