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
            'so_dien_thoai' => ['nullable', 'string', 'max:20',],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'ten_dang_nhap' => ['required', 'string', 'max:50', Rule::unique(User::class)->ignore($user->id, 'ten_dang_nhap')],

            // // SỬA ĐỔI PHẦN NÀY CHO MẬT KHẨU
            // 'password' => ['nullable', 'string', 'min:8'], // Mật khẩu có thể null, string, min 8
            // // Chỉ yêu cầu 'confirmed' khi trường 'password' CÓ MẶT (tức là người dùng đã nhập vào nó)
            // 'password_confirmation' => ['nullable', 'string', 'min:8', 'same:password'], // Thêm 'same:password' thay vì 'confirmed' trên 'password' chính.
        ];
    }
}
