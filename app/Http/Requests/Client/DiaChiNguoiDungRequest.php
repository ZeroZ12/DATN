<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DiaChiNguoiDungRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Chỉ cho phép người dùng đã đăng nhập và được xác thực thực hiện request này.
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten_nguoi_nhan' => ['required', 'string', 'max:255'],
            'so_dien_thoai_nguoi_nhan' => ['required', 'string', 'max:20'], // Có thể thêm rule regex cho định dạng SĐT
            'dia_chi_day_du' => ['required', 'string', 'max:500'],
            'tinh_thanh_pho' => ['required', 'string', 'max:100'],
            'quan_huyen' => ['required', 'string', 'max:100'],
            'phuong_xa' => ['required', 'string', 'max:100'],
            'mac_dinh' => ['sometimes', 'boolean'], // Thêm validation cho mac_dinh
            // 'mac_dinh' => ['boolean'], // Mặc định sẽ được xử lý trong controller
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'ten_nguoi_nhan.required' => 'Tên người nhận không được để trống.',
            'so_dien_thoai_nguoi_nhan.required' => 'Số điện thoại người nhận không được để trống.',
            'dia_chi_day_du.required' => 'Địa chỉ đầy đủ không được để trống.',
            'tinh_thanh_pho.required' => 'Tỉnh/Thành phố không được để trống.',
            'quan_huyen.required' => 'Quận/Huyện không được để trống.',
            'phuong_xa.required' => 'Phường/Xã không được để trống.',
            // ... thêm các thông báo lỗi khác nếu cần
        ];
    }
}
