<?php

namespace App\Http\Requests\Client;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cho phép mọi người dùng đã xác thực thực hiện request này
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $user = $this->user();

        return [
            'ho_ten' => ['required', 'string', 'max:100'],
            'so_dien_thoai' => ['nullable', 'string', 'max:10','regex:/^0+[0-9]{9}$/'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'ten_dang_nhap' => ['required', 'string', 'max:50', Rule::unique(User::class)->ignore($user->id, 'ten_dang_nhap')],

            // // SỬA ĐỔI PHẦN NÀY CHO MẬT KHẨU
            // 'password' => ['nullable', 'string', 'min:8'], // Mật khẩu có thể null, string, min 8
            // // Chỉ yêu cầu 'confirmed' khi trường 'password' CÓ MẶT (tức là người dùng đã nhập vào nó)
            // 'password_confirmation' => ['nullable', 'string', 'min:8', 'same:password'], // Thêm 'same:password' thay vì 'confirmed' trên 'password' chính.
        ]; 
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'so_dien_thoai.regex' => 'Số điện thoại không đúng định dạng. Vui lòng nhập số điện thoại bắt đầu bằng "0" và có 10 chữ số.',
            'so_dien_thoai.max' => 'Số điện thoại người nhận không đúng định dạng.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'ten_dang_nhap.required' => 'Tên đăng nhập không được để trống.',
            'ten_dang_nhap.unique' => 'Tên đăng nhập đã được sử dụng.',
            // 'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            // 'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            // 'password_confirmation.min' => 'Xác nhận mật khẩu phải có ít nhất 8 ký tự.',
            // 'password_confirmation.same' => 'Xác nhận mật khẩu không khớp.',
        ];
    }
}

