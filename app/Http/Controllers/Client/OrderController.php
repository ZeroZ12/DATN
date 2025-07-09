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

    // public function index()
    // {

    //     /** @var \App\Models\User $user */
    //     $user = Auth::user();
    //     $donHangs = $user->donHangs()
    //         ->with([
    //             'maGiamGia',
    //             'phuongThucThanhToan',
    //             'chiTietDonHangs.sanPham',
    //             'chiTietDonHangs.bienTheSanPham',
    //             'chiTietDonHangs.bienTheSanPham.ram',
    //             'chiTietDonHangs.bienTheSanPham.oCung'
    //         ])
    //         ->orderByDesc('created_at')
    //         ->paginate(10);

    //     return view('client.profile.show', [
    //         'donHangs' => $donHangs,
    //         'user' => $user
    //     ]);
    // }


        public function index(Request $request)
    {
        $userId = Auth::id();

        // Lấy danh sách đơn hàng theo người dùng đăng nhập
        $query = DonHang::with(['chiTietDonHangs.sanPham', 'chiTietDonHangs.bienTheSanPham'])
            ->where('id_user', $userId)
            ->orderByDesc('created_at');

        // Nếu có lọc theo trạng thái (tùy chọn)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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
        ->where('id_user', auth()->id()) // đảm bảo chỉ người chủ đơn hàng mới cập nhật
        ->where('trang_thai', 'giao_thanh_cong') // chỉ được cập nhật nếu đúng trạng thái
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
