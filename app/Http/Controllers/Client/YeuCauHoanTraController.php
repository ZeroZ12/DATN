<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\YeuCauHoanTra;
use App\Models\AnhMinhChung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YeuCauHoanTraController extends Controller
{

    public function create($id)
{
    $donHang = DonHang::with('yeuCauHoanTra')
        ->where('id', $id)
        ->where('id_user', auth()->id())
        ->firstOrFail();

    // Chỉ cho phép yêu cầu hoàn trả nếu đơn hàng:
    // 1. Đã giao thành công
    // 2. Hoặc đã hủy bởi admin (không phải khách hoặc hệ thống)
    if (!in_array($donHang->trang_thai, ['giao_thanh_cong', 'da_huy']) ||
        ($donHang->trang_thai === 'da_huy' && !in_array($donHang->huy_boi, ['admin']))) {
        return redirect()->route('client.orders.index')
            ->with('error', 'Đơn hàng này không thể yêu cầu hoàn trả.');
    }

    // Kiểm tra đã có yêu cầu hoàn trả chưa
    if ($donHang->yeuCauHoanTra) {
        return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
    }

    return view('client.hoantra', compact('donHang'));
}


    // Lưu yêu cầu hoàn trả
   public function store(Request $request, $id)
{
    $donHang = DonHang::where('id', $id)
        ->where('id_user', auth()->id())
        ->firstOrFail();

    // Chỉ cho phép hoàn khi giao thành công hoặc hủy bởi admin
    if (!(
        $donHang->trang_thai === 'giao_thanh_cong' ||
        ($donHang->trang_thai === 'da_huy' && $donHang->huy_boi === 'admin')
    )) {
        return redirect()->route('client.orders.index')
            ->with('error', 'Chỉ có đơn giao thành công hoặc bị hủy bởi admin mới được hoàn trả.');
    }

    if ($donHang->yeuCauHoanTra) {
        return back()->with('error', 'Đơn hàng này đã có yêu cầu hoàn trả.');
    }

    // Validate dữ liệu
    $data = $request->validate([
        'sdt_lien_he' => 'required|regex:/^0[0-9]{9}$/',
        'phuong_thuc_hoan_tien' => 'required|in:momo,bank_transfer',

        // Số tài khoản (dùng chung cho momo & bank_transfer)
        'so_tai_khoan' => [
            'required',
            'numeric',
            'digits_between:1,50',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->phuong_thuc_hoan_tien === 'momo' && !preg_match('/^0[0-9]{9}$/', $value)) {
                    $fail('Số tài khoản Momo phải là số điện thoại hợp lệ (10 số, bắt đầu bằng 0).');
                }
            }
        ],

        'ten_chu_tai_khoan' => 'required|max:100',
        'ten_ngan_hang' => 'required_if:phuong_thuc_hoan_tien,bank_transfer|max:100',

        'ly_do' => 'required|string|max:1000',

        'anh_minh_chung' => 'required',
        'anh_minh_chung.*' => 'image|max:2048',
    ], [
        'sdt_lien_he.required' => 'Số điện thoại liên hệ không được để trống.',
        'sdt_lien_he.regex' => 'Số điện thoại không hợp lệ. Phải bắt đầu bằng 0 và có 10 số.',

        'phuong_thuc_hoan_tien.required' => 'Vui lòng chọn phương thức hoàn tiền.',
        'phuong_thuc_hoan_tien.in' => 'Phương thức hoàn tiền không hợp lệ.',

        'so_tai_khoan.required' => 'Vui lòng nhập số tài khoản.',
        'so_tai_khoan.numeric' => 'Số tài khoản chỉ được nhập số.',
        'so_tai_khoan.digits_between' => 'Số tài khoản tối đa 50 số.',

        'ten_chu_tai_khoan.required' => 'Vui lòng nhập tên chủ tài khoản.',
        'ten_chu_tai_khoan.max' => 'Tên chủ tài khoản tối đa 100 ký tự.',

        'ten_ngan_hang.required_if' => 'Vui lòng nhập tên ngân hàng khi chọn chuyển khoản.',
        'ten_ngan_hang.max' => 'Tên ngân hàng tối đa 100 ký tự.',

        'ly_do.required' => 'Vui lòng nhập lý do hoàn trả.',
        'ly_do.max' => 'Lý do tối đa 1000 ký tự.',

        'anh_minh_chung.required' => 'Vui lòng tải lên ít nhất 1 ảnh minh chứng.',
        'anh_minh_chung.*.image' => 'Tệp phải là ảnh.',
        'anh_minh_chung.*.max' => 'Ảnh không được vượt quá 2MB.',
    ]);

    // Lưu yêu cầu hoàn trả
    $data['id_don_hang'] = $donHang->id;
    $data['ma_hoan_tra'] = 'HT' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $data['trang_thai'] = 'cho_phe_duyet';

    $yeuCau = YeuCauHoanTra::create($data);

    // Lưu ảnh minh chứng
    if ($request->hasFile('anh_minh_chung')) {
        foreach ($request->file('anh_minh_chung') as $file) {
            if ($file && $file->isValid()) {
                $path = $file->store('minhchung', 'public');
                AnhMinhChung::create([
                    'id_yeu_cau_hoan_tra' => $yeuCau->id,
                    'duong_dan' => '/storage/' . $path,
                ]);
            }
        }
    }

    return redirect()->route('client.orders.index')
        ->with('success', 'Yêu cầu hoàn trả đã được gửi.');
}


    // Xác nhận đã gửi trả hàng
  public function traHang($id)
{
    $ycht = YeuCauHoanTra::where('id', $id)
        ->whereHas('donHang', fn ($q) => $q->where('id_user', auth()->id()))
        ->firstOrFail();

    if ($ycht->trang_thai === 'da_phe_duyet') {
        $ycht->update([
            'trang_thai' => 'dang_van_chuyen_tra_hang',
            'thoi_gian_tra_hang' => now(),
            'trang_thai_vc_hoan_hang'=> 'dang_giao_hang' // ✅ update trạng thái VC hoàn hàng
        ]);
    }

    return redirect()->route('client.orders.index')->with('success', 'Bạn đã xác nhận gửi trả hàng.');
}

}
