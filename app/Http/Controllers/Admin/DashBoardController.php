<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index()
    {
       $thongKeTrangThai = // Công việc cần làm
       [
        'cho_xac_nhan',
        'yeu_cau_hoan_tra',
        'hoan_thanh',
        'da_hoan_tien'
       ];

       // Thống kê số lượng đơn hàng theo trạng thái đơn
       $thongKeDonHang = DonHang::whereIn('trang_thai', $thongKeTrangThai)
       ->select('trang_thai', DB::raw('count(*) as tong'))
       ->groupBy('trang_thai')
       ->pluck('tong', 'trang_thai');
       
       $thongKe = [];
       foreach($thongKeTrangThai as $trangThai)
       {
        $thongKe[$trangThai] = $thongKeDonHang[$trangThai] ?? 0; // Đảm bảo mọi trạng thái đều có giá trị
       }

       // Doanh số bán hàng theo ngày, tháng, năm.
       $homnay = Carbon::today();
       $thangHienTai = Carbon::now()->month;
       $namHienTai = Carbon::now()->year;
       // Doanh Số Ngày Hiện Tại
       $doanhSoNgay = DonHang::whereDate('created_at', $homnay)
       ->where('trang_thai', 'hoan_thanh')
       ->sum('tong_tien');
       // Doanh Số Tháng Hiện Tại
       $doanhSoThang = DonHang::whereMonth('created_at', $thangHienTai)
       ->whereYear('created_at', $namHienTai)->where('trang_thai', 'hoan_thanh')
       ->sum('tong_tien');
       // Doanh Số Năm Hiện Tại
       $doanhSoNam = DonHang::whereYear('created_at', $namHienTai)->where('trang_thai', 'hoan_thanh')
       ->sum('tong_tien');
       // Tổng Doanh Số 
       $tongDoanhSo = DonHang::where('trang_thai', 'hoan_thanh')->sum('tong_tien');
       
       return view('admin.layouts.dashboard', compact('thongKe', 'doanhSoNgay','doanhSoThang','doanhSoNam','tongDoanhSo'));
    }
}
