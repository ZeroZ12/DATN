<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function success($id)
    {
        $donHang = DonHang::where('id_user', Auth::id())
            ->where('id', $id)
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->firstOrFail();

        return view('client.order-success', compact('donHang'));
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = DonHang::with([
            'chiTietDonHangs.sanPham',
            'chiTietDonHangs.bienTheSanPham',
            'yeuCauHoanTra' // để load luôn nếu có
        ])->where('id_user', $userId)
          ->orderByDesc('created_at');

        // Lọc theo trạng thái
        if ($request->filled('trang_thai')) {
            if ($request->trang_thai === 'hoan_tra') {
                // Trả hàng / Hoàn tiền → whereHas yêuCauHoanTra
                $query->whereHas('yeuCauHoanTra');
            } else {
                // Các trạng thái bình thường
                $query->where('trang_thai', $request->trang_thai);
            }
        }

        $donHangs = $query->get();

        return view('client.donhang', compact('donHangs'));
    }

    public function show($id)
    {
        $donHang = DonHang::with([
            'user',
            'diaChiNguoiDung',
            'phuongThucThanhToan',
            'chiTietDonHangs.bienTheSanPham.sanPham',
            'yeuCauHoanTra.anhMinhChung'
        ])->where('id', $id)
          ->first();

        if (!$donHang || $donHang->id_user !== Auth::id()) {
            return redirect()->route('client.orders.index')
                ->with('error', 'Bạn không có quyền xem chi tiết đơn hàng này.');
        }

        return view('client.chitietdonhang', compact('donHang'));
    }

    public function daNhanHang($id)
    {
        $donHang = DonHang::where('id', $id)
            ->where('id_user', Auth::id())
            ->where('trang_thai', 'giao_thanh_cong')
            ->firstOrFail();

        $donHang->update([
            'trang_thai' => 'hoan_thanh',
            'updated_at' => now(),
        ]);

        return redirect()->route('client.orders.index')->with('success', 'Đơn hàng đã được xác nhận là đã nhận.');
    }

    public function cancel($id)
    {
        $user = Auth::user();

        /** @var \App\Models\User $user */
        $order = $user->donHangs()->where('id', $id)->firstOrFail();

        // Chỉ cho phép hủy nếu đơn hàng chưa xử lý
        if (in_array($order->trang_thai, ['cho_xac_nhan', 'cho_thanh_toan', 'chuan_bi_hang'])) {
            $order->update([
                'trang_thai' => 'da_huy',
                'huy_boi' => 'khach_hang',
            ]);
        // Hoàn lại số lượng mã giảm giá nếu có
        if ($order->maGiamGia)
        {
            $maGiamGia = $order->maGiamGia;
            $maGiamGia->so_luong += 1;
            $maGiamGia->save();
        }
        foreach ($order->chiTietDonHangs as $chiTiet) {
            $bienThe = $chiTiet->bienTheSanPham; // hoặc $chiTiet->sanPham nếu bạn không dùng biến thể
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
            return redirect()->route('client.orders.index')
                ->with('success', 'Đơn hàng đã được hủy thành công.');
        }

        return redirect()->route('client.orders.index')
            ->with('error', 'Không thể hủy đơn hàng ở trạng thái hiện tại.');
    }
}

