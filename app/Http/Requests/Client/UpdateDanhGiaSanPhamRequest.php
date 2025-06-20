<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDanhGiaSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Kiểm tra xem người dùng hiện tại có phải là chủ sở hữu của đánh giá này không
        // hoặc có vai trò quản trị (admin) để có thể sửa/xóa nó.
        // Tham số route 'danhGiaSanPham' tự động được inject vào request.
        return Auth::check() && (Auth::id() === $this->danhGiaSanPham->id_user || Auth::user()->vai_tro === 'admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'so_sao' => 'required|integer|min:1|max:5',
            'binh_luan' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'so_sao.required' => 'Vui lòng chọn số sao.',
            'so_sao.integer' => 'Số sao phải là số nguyên.',
            'so_sao.min' => 'Số sao phải từ 1 đến 5.',
            'so_sao.max' => 'Số sao phải từ 1 đến 5.',
            'binh_luan.string' => 'Bình luận phải là chuỗi ký tự.',
            'binh_luan.max' => 'Bình luận không được vượt quá 1000 ký tự.',
        ];
    }
}