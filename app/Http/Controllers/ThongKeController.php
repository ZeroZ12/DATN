<?php

namespace App\Http\Controllers;

use App\Models\BienTheSanPham;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->format('Y-m-d');

        // Query doanh thu: chỉ lấy đơn hoàn thành, chưa hoàn tiền
        $revenueQuery = DonHang::where('trang_thai', 'hoan_thanh')
            ->where(function($q) {
                $q->doesntHave('yeuCauHoanTra')
                  ->orWhereHas('yeuCauHoanTra', fn($sub) => $sub->where('trang_thai', '!=', 'da_hoan_tien'));
            });

        // Tổng quan doanh thu
        $doanhThuHomNay = (clone $revenueQuery)->whereDate('updated_at', $today)->sum('tong_tien');
        $soDonHomNay    = (clone $revenueQuery)->whereDate('updated_at', $today)->count();

        $doanhThuThang  = (clone $revenueQuery)->whereMonth('updated_at', now()->month)
                                                ->whereYear('updated_at', now()->year)
                                                ->sum('tong_tien');
        $soDonThang     = (clone $revenueQuery)->whereMonth('updated_at', now()->month)
                                                ->whereYear('updated_at', now()->year)
                                                ->count();

        $doanhThuNam    = (clone $revenueQuery)->whereYear('updated_at', now()->year)->sum('tong_tien');
        $soDonNam       = (clone $revenueQuery)->whereYear('updated_at', now()->year)->count();

        // Filter chart & orders
        $type = $request->input('type', 'ngay'); // ngay, thang, nam, range
        $labels = [];
        $chartData = [];
        $totalDoanhThuFilter = 0;
        $totalDonHangFilter = 0;
        $labelFilter = '';

        // Query danh sách đơn hàng hiển thị tất cả trạng thái
        $ordersQuery = DonHang::query();

        // Xử lý filter theo type
        if ($type === 'ngay') {
            $days = $request->filled('day') ? [Carbon::parse($request->day)] : collect(range(6,0))->map(fn($i)=> now()->subDays($i));
            foreach($days as $date){
                $labels[] = $date->format('d/m');
                $chartData[] = (clone $revenueQuery)->whereDate('updated_at', $date->format('Y-m-d'))->sum('tong_tien');
            }
            $totalDoanhThuFilter = array_sum($chartData);

            $totalDonHangFilter = (clone $revenueQuery)
                ->where(function($q) use ($days){
                    foreach($days as $date){
                        $q->orWhereDate('updated_at', $date->format('Y-m-d'));
                    }
                })->count();

            $labelFilter = count($days)===1
                ? $days[0]->format('d/m/Y')
                : $days[0]->format('d/m/Y').' - '.$days[count($days)-1]->format('d/m/Y');

            $ordersQuery = $ordersQuery->where(function($q) use ($days){
                foreach($days as $date){
                    $q->orWhereDate('updated_at', $date->format('Y-m-d'));
                }
            });
        }
        elseif ($type === 'thang' && $request->filled('month')) {
            $month = Carbon::parse($request->month);
            for($i=1; $i<=$month->daysInMonth; $i++){
                $labels[] = $i.'/'.$month->format('m');
                $chartData[] = (clone $revenueQuery)->whereYear('updated_at',$month->year)
                                                   ->whereMonth('updated_at',$month->month)
                                                   ->whereDay('updated_at',$i)
                                                   ->sum('tong_tien');
            }
            $totalDoanhThuFilter = array_sum($chartData);
            $totalDonHangFilter = (clone $revenueQuery)
                                    ->whereYear('updated_at',$month->year)
                                    ->whereMonth('updated_at',$month->month)
                                    ->count();
            $labelFilter = $month->format('m/Y');

            $ordersQuery->whereYear('updated_at',$month->year)->whereMonth('updated_at',$month->month);
        }
        elseif ($type === 'nam' && $request->filled('year')) {
            $year = (int)$request->year;
            for($i=1;$i<=12;$i++){
                $labels[] = 'Tháng '.$i;
                $chartData[] = (clone $revenueQuery)->whereYear('updated_at',$year)
                                                   ->whereMonth('updated_at',$i)
                                                   ->sum('tong_tien');
            }
            $totalDoanhThuFilter = array_sum($chartData);
            $totalDonHangFilter = (clone $revenueQuery)->whereYear('updated_at',$year)->count();
            $labelFilter = $year;

            $ordersQuery->whereYear('updated_at',$year);
        }
        elseif ($type === 'range' && $request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to   = Carbon::parse($request->to)->endOfDay();
            for($date = $from->copy(); $date->lte($to); $date->addDay()){
                $labels[] = $date->format('d/m');
                $chartData[] = (clone $revenueQuery)->whereDate('updated_at', $date->format('Y-m-d'))->sum('tong_tien');
            }
            $totalDoanhThuFilter = array_sum($chartData);
            $totalDonHangFilter = (clone $revenueQuery)->whereBetween('updated_at', [$from,$to])->count();
            $labelFilter = ['from'=>$from->format('d/m/Y'),'to'=>$to->format('d/m/Y')];

            $ordersQuery->whereBetween('updated_at', [$from,$to]);
        }

        // Nếu không filter, lấy 10 đơn gần nhất
        if(!($request->filled('day') || $request->filled('month') || $request->filled('year') || ($request->filled('from') && $request->filled('to')))){
            $ordersQuery = $ordersQuery->orderBy('updated_at','desc')->limit(10);
        }

        $orders = $ordersQuery->where('trang_thai','hoan_thanh')->orderBy('updated_at','desc')->get();

        if($request->ajax()){
            return response()->json([
                'labels'=>$labels,
                'chartData'=>$chartData,
                'orders'=>$orders->map(fn($o)=>[
                    'ma_don'=>$o->ma_don,
                    'ten_khach'=>$o->khachHang->ho_ten ?? 'Họ tên',
                    'tong_tien'=>$o->tong_tien,
                    'trang_thai'=>$o->trang_thai,
                    'updated_at'=>$o->updated_at->format('d/m/Y H:i')
                ])
            ]);
        }

         $sanPhamBanChay = SanPham::whereNull('deleted_at')
    ->orderByDesc('luot_mua')
    ->limit(5)
    ->get();

    $sanPhamXemNhieu = SanPham::whereNull('deleted_at')
    ->orderByDesc('luot_xem')
    ->limit(5)
    ->get();
        $sanPhamSapHetHang = BienTheSanPham::with('sanPham')
    ->where('ton_kho', '<', 5)
    ->orderBy('ton_kho', 'asc')
    ->limit(10)
    ->get();

        return view('admin.thongke.index', compact(
            'doanhThuHomNay','soDonHomNay',
            'doanhThuThang','soDonThang',
            'doanhThuNam','soDonNam',
            'labels','chartData','type',
            'totalDoanhThuFilter','totalDonHangFilter','labelFilter',
            'orders',
            'sanPhamBanChay',
            'sanPhamXemNhieu',
            'sanPhamSapHetHang'
        ));
    }
}
