<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->format('Y-m-d');

        // Query chung: chỉ lấy đơn hoàn thành, chưa hoàn tiền
        $query = DonHang::where('trang_thai', 'hoan_thanh')
            ->where(function($q) {
                $q->doesntHave('yeuCauHoanTra')
                  ->orWhereHas('yeuCauHoanTra', fn($sub) => $sub->where('trang_thai', '!=', 'da_hoan_tien'));
            });

        // Tổng quan doanh thu
        $doanhThuHomNay = (clone $query)->whereDate('updated_at', $today)->sum('tong_tien');
        $soDonHomNay    = (clone $query)->whereDate('updated_at', $today)->count();

        $doanhThuThang  = (clone $query)->whereMonth('updated_at', now()->month)
                                        ->whereYear('updated_at', now()->year)
                                        ->sum('tong_tien');
        $soDonThang     = (clone $query)->whereMonth('updated_at', now()->month)
                                        ->whereYear('updated_at', now()->year)
                                        ->count();

        $doanhThuNam    = (clone $query)->whereYear('updated_at', now()->year)->sum('tong_tien');
        $soDonNam       = (clone $query)->whereYear('updated_at', now()->year)->count();

        // Filter chart
        $type = $request->input('type', 'ngay'); // ngay, thang, nam, range
        $labels = [];
        $chartData = [];
        $totalDoanhThuFilter = 0;
        $totalDonHangFilter = 0;
        $labelFilter = '';
        $ordersQuery = clone $query;

        if ($type === 'ngay') {
            $days = $request->filled('day')
                ? [Carbon::parse($request->day)]
                : collect(range(6,0))->map(fn($i)=> now()->subDays($i));

            foreach($days as $date){
                $labels[] = $date->format('d/m');
                $chartData[] = (clone $query)->whereDate('updated_at', $date->format('Y-m-d'))->sum('tong_tien');
            }

            $totalDoanhThuFilter = array_sum($chartData);

            // Sửa: dùng whereDate thay vì whereIn
            $totalDonHangFilter = (clone $query)
                ->where(function($q) use ($days){
                    foreach($days as $date){
                        $q->orWhereDate('updated_at', $date->format('Y-m-d'));
                    }
                })->count();

            $labelFilter = count($days)===1
                ? $days[0]->format('d/m/Y')
                : $days[0]->format('d/m/Y').' - '.$days[count($days)-1]->format('d/m/Y');

            $ordersQuery = (clone $query)
                ->where(function($q) use ($days){
                    foreach($days as $date){
                        $q->orWhereDate('updated_at', $date->format('Y-m-d'));
                    }
                });
        }
        elseif ($type === 'range' && $request->filled('from') && $request->filled('to')) {
            $from = Carbon::parse($request->from)->startOfDay();
            $to   = Carbon::parse($request->to)->endOfDay();

            for($date = $from->copy(); $date->lte($to); $date->addDay()){
                $labels[] = $date->format('d/m');
                $chartData[] = (clone $query)->whereDate('updated_at', $date->format('Y-m-d'))->sum('tong_tien');
            }

            $totalDoanhThuFilter = array_sum($chartData);

            // Sửa: dùng whereBetween với startOfDay và endOfDay
            $totalDonHangFilter = (clone $query)
                ->whereBetween('updated_at', [$from, $to])
                ->count();

            $labelFilter = ['from'=>$from->format('d/m/Y'),'to'=>$to->format('d/m/Y')];

            $ordersQuery = (clone $query)
                ->whereBetween('updated_at', [$from, $to]);
        }

        // Lấy 10 đơn gần nhất nếu không có filter đầy đủ
        if (($type==='ngay' && !$request->filled('day')) ||
            ($type==='range' && (!$request->filled('from') || !$request->filled('to'))) ||
            ($type==='thang' && !$request->filled('month')) ||
            ($type==='nam' && !$request->filled('year'))
        ){
            $ordersQuery = (clone $query)->orderBy('updated_at','desc')->limit(10);
        }

        $orders = $ordersQuery->orderBy('updated_at','desc')->get();

        if($request->ajax()){
            return response()->json([
                'labels'=>$labels,
                'chartData'=>$chartData,
                'orders'=>$orders->map(fn($o)=>[
                    'ma_don'=>$o->ma_don,
                    'ten_khach'=>$o->khachHang->ten ?? 'Khách vãng lai',
                    'tong_tien'=>$o->tong_tien,
                    'trang_thai'=>$o->trang_thai,
                    'updated_at'=>$o->updated_at->format('d/m/Y H:i')
                ])
            ]);
        }

        return view('admin.thongke.index', compact(
            'doanhThuHomNay','soDonHomNay',
            'doanhThuThang','soDonThang',
            'doanhThuNam','soDonNam',
            'labels','chartData','type',
            'totalDoanhThuFilter','totalDonHangFilter','labelFilter',
            'orders'
        ));
    }
}
