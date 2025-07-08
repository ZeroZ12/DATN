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

    public function index()
    {

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
            'user' => $user
        ]);
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
    public function return($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $order = $user->donHangs()->where('id', $id)->firstOrFail();

        // Kiểm tra trạng thái đơn hàng có phải là giao hàng thành công hay không và Chỉ cho phép hoàn trả khi trạng thái phù hợp và trong 7 ngày
        if ($order->trang_thai == 'giao_thanh_cong' &&
            \Carbon\Carbon::parse($order->created_at)->diffInDays(now()) <= 7
        ) {
            $order->trang_thai = 'yeu_cau_hoan_tra';
            $order->save();
            return redirect()->route('client.orders.show', $order->id)->with('success', 'Yêu cầu hoàn trả đã được gửi.');
        }
            return redirect()->route('client.orders.show', $order->id)->with('error', 'Không thể hoàn trả đơn hàng này.');
    }

 public function cancel(Request $request, $id)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $order = $user->donHangs()->where('id', $id)->firstOrFail();

    $request->validate([
        'trang_thai_hien_tai' => 'required|string',
    ]);

    if ($order->trang_thai !== $request->trang_thai_hien_tai) {
        return redirect()->route('client.orders.show', $order->id)
            ->with('error', 'Đơn hàng đã được cập nhật trạng thái trước đó. Không thể hủy.');
    }

    if (in_array($order->trang_thai, ['cho_xac_nhan', 'cho_thanh_toan', 'chuan_bi_hang'])) {
        $order->update([
            'trang_thai' => 'da_huy',
            'huy_boi' => 'khach_hang',
        ]);

        return redirect()->route('client.orders.show', $order->id)
            ->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    return redirect()->route('client.orders.show', $order->id)
        ->with('error', 'Không thể hủy đơn hàng ở trạng thái hiện tại.');
}


}
