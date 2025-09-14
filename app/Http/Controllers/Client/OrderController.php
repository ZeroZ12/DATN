<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            // 'yeuCauHoanTra' // để load luôn nếu có
        ])->where('id_user', $userId)
          ->orderByDesc('created_at');

        // Lọc theo trạng thái
        // if ($request->filled('trang_thai')) {
        //     if ($request->trang_thai === 'hoan_tra') {
        //         // Trả hàng / Hoàn tiền → whereHas yêuCauHoanTra
        //         $query->whereHas('yeuCauHoanTra');
        //     } else {
        //         // Các trạng thái bình thường
        //         $query->where('trang_thai', $request->trang_thai);
        //     }
        // }

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
            // 'yeuCauHoanTra.anhMinhChung'
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

    public function requestRefundForm($id)
{
    $donHang = DonHang::where('id', $id)
        ->where('id_user', Auth::id())
        ->whereIn('trang_thai', ['giao_thanh_cong'])//chỉ giao thành công mới đc hoàn
        ->firstOrFail();

    return view('client.hoantien', compact('donHang'));
}
public function requestRefund(Request $request, $id)
{
    $donHang = DonHang::where('id', $id)
        ->where('id_user', Auth::id())
        ->whereIn('trang_thai', ['giao_thanh_cong'])
        ->firstOrFail();

    // Validate form
    $request->validate([
        'phuong_thuc_hoan_tien' => ['required', 'string'],
        'ten_ngan_hang' => ['required_if:phuong_thuc_hoan_tien,chuyen_khoan', 'string', 'max:100', 'nullable'],
        'so_tai_khoan' => ['required', 'regex:/^[0-9]{6,55}$/'],
        'ly_do' => ['required', 'string', 'max:500'],
        'anh_minh_chung'   => ['required'], // ít nhất 1 ảnh
        'anh_minh_chung.*' => ['image', 'mimes:jpg,jpeg,png,webp'],
    ], [
        'phuong_thuc_hoan_tien.required' => 'Vui lòng chọn phương thức hoàn tiền.',
        'ten_ngan_hang.required_if' => 'Vui lòng chọn ngân hàng khi chọn chuyển khoản.',
        'so_tai_khoan.required' => 'Vui lòng nhập số tài khoản/Momo.',
        'so_tai_khoan.regex' => 'Số tài khoản/Momo phải gồm 6–55 chữ số.',
        'ly_do.required' => 'Vui lòng nhập lý do hoàn tiền.',
        'anh_minh_chung.required' => 'Vui lòng tải lên ít nhất 1 ảnh minh chứng.',
        'anh_minh_chung.*.image' => 'File tải lên phải là ảnh.',
        'anh_minh_chung.*.mimes' => 'Ảnh phải có định dạng jpg, jpeg, png hoặc webp.',

    ]);

    DB::transaction(function () use ($request, $donHang) {
        $donHang->update([
            'trang_thai' => 'yeu_cau_hoan_tra',
            'phuong_thuc_hoan_tien' => $request->phuong_thuc_hoan_tien,
            'ten_ngan_hang' => $request->phuong_thuc_hoan_tien === 'chuyen_khoan' ? $request->ten_ngan_hang : null,
            'so_tai_khoan' => $request->so_tai_khoan,
            'ly_do' => $request->ly_do,
        ]);

        foreach ($request->file('anh_minh_chung') as $file) {
            $duongDan = $file->store('refunds', 'public');

            $donHang->anhMinhChungs()->create([
                'loai' => "nguoi_dung",
                'duong_dan' => $duongDan,
            ]);
        }
    });

    return redirect()->route('client.orders.show', $donHang->id)
        ->with('success', 'Yêu cầu hoàn trả đã được gửi thành công.');
}

public function xacNhanTraHang($id)
{
    // Lấy đơn hàng của user hiện tại
    $donHang = DonHang::where('id', $id)
        ->where('id_user', auth()->id())
        ->firstOrFail();

    // Chỉ xử lý nếu trạng thái hiện tại là "da_phe_duyet" (đã phê duyệt trả hàng)
    if ($donHang->trang_thai === 'da_phe_duyet') {
        $donHang->update([
            'trang_thai' => 'dang_tra_hang', // cập nhật sang trạng thái đang trả hàng
            'thoi_gian_khach_tra' => now(),   // lưu thời gian xác nhận trả hàng;
            'trang_thai_vc_hoan'=>'dang_tra'
        ]);

        return redirect()->route('client.orders.index')
            ->with('success', 'Bạn đã xác nhận gửi trả hàng.');
    }

    return redirect()->route('client.orders.index')
        ->with('error', 'Không thể xác nhận trả hàng với trạng thái hiện tại.');
}

}
