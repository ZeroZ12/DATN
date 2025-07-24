<?php

namespace App\Http\Controllers\Admin;

use App\Models\BienTheSanPham;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\YeuCauHoanTra;
use Carbon\Carbon;

class DashBoardController extends Controller
{
  public function index(Request $request)
  {
    $trangThaiDonHangs = [
      'cho_xac_nhan',
      'hoan_thanh',
      'da_hoan_tien'
    ];

    // Thống kê số lượng đơn hàng theo trạng thái đơn
    $thongKeDonHang = DonHang::whereIn('trang_thai', $trangThaiDonHangs)
      ->select('trang_thai', DB::raw('count(*) as tong'))
      ->groupBy('trang_thai')
      ->pluck('tong', 'trang_thai');

    $thongKe = [];
    foreach ($trangThaiDonHangs as $trangThai) {
      $thongKe[$trangThai] = $thongKeDonHang[$trangThai] ?? 0; // Đảm bảo mọi trạng thái đều có giá trị
    }

    $trangThaiHoanTra = [
      'cho_phe_duyet',
      'da_phe_duyet',
      'tu_choi',
      'dang_van_chuyen_tra_hang',
      'da_nhan_hang',
      'da_hoan_tien'
    ];
    $thongKeHoanTra = YeuCauHoanTra::whereIn('trang_thai', $trangThaiHoanTra)
      ->select('trang_thai', DB::raw('count(*) as tong'))
      ->groupBy('trang_thai')
      ->pluck('tong', 'trang_thai');
    $HoanTra = [];
    // Thống kê số lượng yêu cầu hoàn trả theo trạng thái
    foreach ($trangThaiHoanTra as $trangThais) {
      $HoanTra[$trangThais] = $thongKeHoanTra[$trangThais] ?? 0; // Đảm bảo mọi trạng thái đều có giá trị
    }
    // Doanh số bán hàng theo ngày, tháng, năm.
    $homnay = Carbon::today();
    $thangHienTai = Carbon::now()->month;
    $namHienTai = Carbon::now()->year;
    // Doanh Số Ngày Hiện Tại
    $doanhSoNgay = DonHang::whereDate('updated_at', $homnay)
      ->where('trang_thai', 'hoan_thanh')
      ->sum('tong_tien');
    // Doanh Số Tháng Hiện Tại
    $doanhSoThang = DonHang::whereMonth('updated_at', $thangHienTai)
      ->whereYear('updated_at', $namHienTai)->where('trang_thai', 'hoan_thanh')
      ->sum('tong_tien');
    // Doanh Số Năm Hiện Tại
    $doanhSoNam = DonHang::whereYear('updated_at', $namHienTai)->where('trang_thai', 'hoan_thanh')
      ->sum('tong_tien');
    // Tổng Doanh Số
    $tongDoanhSo = DonHang::where('trang_thai', 'hoan_thanh')->sum('tong_tien');

    // Xử lý filter doanh số
    $doanhSoFilter = null;
    $filterType = $request->input('filter_type', 'range');
    if ($filterType === 'range' && $request->filled(['from', 'to'])) {
      $from = $request->input('from');
      $to = $request->input('to');
      $doanhSoFilter = DonHang::where('trang_thai', 'hoan_thanh')
        ->whereDate('updated_at', '>=', $from)
        ->whereDate('updated_at', '<=', $to)
        ->sum('tong_tien');
    } elseif ($filterType === 'day' && $request->filled('day')) {
      $day = $request->input('day');
      $doanhSoFilter = DonHang::where('trang_thai', 'hoan_thanh')
        ->whereDate('updated_at', $day)
        ->sum('tong_tien');
    } elseif ($filterType === 'month' && $request->filled('month')) {
      $month = $request->input('month'); // dạng yyyy-mm
      $parts = explode('-', $month);
      if (count($parts) === 2) {
        $doanhSoFilter = DonHang::where('trang_thai', 'hoan_thanh')
          ->whereMonth('updated_at', $parts[1])
          ->whereYear('updated_at', $parts[0])
          ->sum('tong_tien');
      }
    } elseif ($filterType === 'year' && $request->filled('year')) {
      $year = $request->input('year');
      $doanhSoFilter = DonHang::where('trang_thai', 'hoan_thanh')
        ->whereYear('updated_at', $year)
        ->sum('tong_tien');
    }
 $sanPhamBanChay = SanPham::whereNull('deleted_at')
    ->orderByDesc('luot_mua')
    ->limit(5)
    ->get();

    $sanPhamXemNhieu = SanPham::whereNull('deleted_at')
    ->orderByDesc('luot_xem')
    ->limit(10)
    ->get();
    $donHangHoanThanh = DonHang::where('trang_thai', 'hoan_thanh')
    ->whereDoesntHave('yeuCauHoanTra') // không có yêu cầu hoàn trả
    ->latest()
    ->take(15)
    ->get();
    $sanPhamSapHetHang = BienTheSanPham::with('sanPham')
    ->where('ton_kho', '<', 5)
    ->orderBy('ton_kho', 'asc')
    ->limit(10)
    ->get();
    return view('admin.layouts.dashboard', compact('sanPhamSapHetHang','donHangHoanThanh','sanPhamXemNhieu','sanPhamBanChay','thongKe', 'HoanTra', 'doanhSoNgay', 'doanhSoThang', 'doanhSoNam', 'tongDoanhSo', 'doanhSoFilter'));
  }
}
