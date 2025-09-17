<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
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
    $request->validate([
        'trang_thai' => 'required|in:' . implode(',', DonHang::TRANG_THAI),
        'trang_thai_hien_tai' => 'required|string',
    ]);

    $donHang = DonHang::with('chiTietDonHangs.sanPham')->findOrFail($id);

    if ($donHang->trang_thai !== $request->trang_thai_hien_tai) {
        return redirect()->back()->with('error', 'Trạng thái đơn hàng đã thay đổi. Vui lòng tải lại trang.');
    }

    $trangThaiCu  = $donHang->trang_thai;
    $trangThaiMoi = $request->trang_thai;

    // Cập nhật trạng thái
    if ($trangThaiMoi === 'da_huy') {
         foreach ($donHang->chiTietDonHangs as $chiTiet) {
            $bienThe = $chiTiet->bienTheSanPham;
            if ($bienThe) {
                $bienThe->ton_kho += $chiTiet->so_luong;
                $bienThe->save();
            }
                    else if ($chiTiet->sanPham) {
            $sanPham = $chiTiet->sanPham;
            $sanPham->so_luong += $chiTiet->so_luong;
            $sanPham->save();
        }

        }
        $donHang->update([
            'trang_thai' => 'da_huy',
            'huy_boi' => 'admin',
        ]);
    } else {
        $donHang->update([
            'trang_thai' => $trangThaiMoi,
            'trang_thai_vc_giao_hang' => match($trangThaiMoi) {
            'dang_giao_hang' => 'dang_giao_hang',
            'giao_thanh_cong' => 'giao_thanh_cong',
            'giao_that_bai'=>'giao_that_bai',
            default => $donHang->trang_thai_vc_giao_hang,
        },
        ]);


    }

    // ✅ Chỉ cộng luot_mua nếu trạng thái mới là giao_thanh_cong
    // Và trạng thái cũ chưa phải là giao_thanh_cong hoặc hoan_thanh
    if (
        $trangThaiMoi === 'giao_thanh_cong' &&
        !in_array($trangThaiCu, ['giao_thanh_cong', 'hoan_thanh'])
    ) {
        // Nếu không có yêu cầu hoàn trả
        $coYeuCauHoanTra = YeuCauHoanTra::where('id_don_hang', $donHang->id)->exists();

        if (!$coYeuCauHoanTra) {
            foreach ($donHang->chiTietDonHangs as $chiTiet) {
                $sanPham = $chiTiet->sanPham;
                if ($sanPham) {
                    $sanPham->luot_mua += $chiTiet->so_luong;
                    $sanPham->save();
                }
            }
        }
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
