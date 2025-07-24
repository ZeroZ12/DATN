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
        $selectedDonHang = DonHang::where('id_user', Auth::id())
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

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $donHangs = $user->donHangs()
            ->with([
                'maGiamGia',
                'phuongThucThanhToan',
                'chiTietDonHangs.sanPham',
                'chiTietDonHangs.bienTheSanPham',
                'chiTietDonHangs.bienTheSanPham.ram',
                'chiTietDonHangs.bienTheSanPham.oCung'
            ])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('client.profile.show', [
            'donHangs' => $donHangs,
            'user' => $user,
            'selectedDonHang' => $selectedDonHang,
        ]);
    }

 public function daNhanHang($id)
{
    $donHang = DonHang::where('id', $id)
        ->where('id_user', auth()->id())
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

        return redirect()->route('client.orders.index')
            ->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    return redirect()->route('client.orders.index')
        ->with('error', 'Không thể hủy đơn hàng ở trạng thái hiện tại.');
}



}
