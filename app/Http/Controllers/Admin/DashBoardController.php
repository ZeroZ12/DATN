<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SanPham;
use App\Models\DonHang;
use App\Models\YeuCauHoanTra;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $tongKhachHang = User::count();
        $tongSanPham   = SanPham::count();
        $tongDonHang   = DonHang::count();

        // Danh sách cần xử lý
        $donChoXacNhan   = DonHang::where('trang_thai', 'cho_xac_nhan')->count();
        $donDangGiao     = DonHang::where('trang_thai', 'dang_giao')->count();
        $donHoanThanh    = DonHang::where('trang_thai', 'hoan_thanh')->count();

        // Yêu cầu hoàn trả (chỉ tính những cái đang chờ phê duyệt)
        $yeuCauHoanTraChoDuyet = YeuCauHoanTra::where('trang_thai', 'cho_phe_duyet')->count();

        // Dữ liệu hôm nay
        $today = Carbon::today();
        $khachMoiHomNay   = User::whereDate('created_at', $today)->count();
        $sanPhamMoiHomNay = SanPham::whereDate('created_at', $today)->count();
        $donHangHomNay    = DonHang::whereDate('created_at', $today)->count();

        return view('admin.layouts.dashboard', compact(
            'tongKhachHang',
            'tongSanPham',
            'tongDonHang',
            'donChoXacNhan',
            'donDangGiao',
            'donHoanThanh',
            'yeuCauHoanTraChoDuyet',
            'khachMoiHomNay',
            'sanPhamMoiHomNay',
            'donHangHomNay'
        ));
    }
}

