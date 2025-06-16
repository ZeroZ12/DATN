<?php

namespace App\Http\Requests\Client;

use Illuminate\Validation\Rules\Password; // Import lớp Password rules
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Chỉ người dùng đã xác thực mới được phép cập nhật mật khẩu của họ
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
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                // Kiểm tra mật khẩu hiện tại có khớp với mật khẩu của người dùng không
                if (! Hash::check($value, Auth::user()->password)) {
                    $fail('Mật khẩu hiện tại không chính xác.');
                }
            }],
            'password' => [
                'required',
                'string',
                Password::min(8) // Mật khẩu tối thiểu 8 ký tự
                            ->mixedCase()      // Bao gồm chữ hoa và chữ thường
                            ->numbers()        // Bao gồm số
                            ->symbols(),       // Bao gồm ký tự đặc biệt
                'confirmed', // Đảm bảo trường 'password_confirmation' khớp
            ],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại của bạn.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.mixed_case' => 'Mật khẩu mới phải chứa cả chữ hoa và chữ thường.',
            'password.numbers' => 'Mật khẩu mới phải chứa ít nhất một số.',
            'password.symbols' => 'Mật khẩu mới phải chứa ít nhất một ký tự đặc biệt.',
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ];
    }
}