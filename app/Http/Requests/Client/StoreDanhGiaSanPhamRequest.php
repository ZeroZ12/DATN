<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Import facade Auth

class StoreDanhGiaSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // TRỌNG TÂM CỦA GIẢI PHÁP:
        // Phương thức này sẽ kiểm tra xem người dùng đã đăng nhập chưa.
        // Nếu người dùng đã đăng nhập, trả về true và cho phép request đi tiếp.
        // Nếu chưa, Laravel sẽ tự động chuyển hướng về trang đăng nhập hoặc trả về lỗi 403.
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_product' => 'required|exists:san_phams,id',
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
            'id_product.required' => 'Sản phẩm không được để trống.',
            'id_product.exists' => 'Sản phẩm không tồn tại.',
            'so_sao.required' => 'Vui lòng chọn số sao.',
            'so_sao.integer' => 'Số sao phải là số nguyên.',
            'so_sao.min' => 'Số sao phải từ 1 đến 5.',
            'so_sao.max' => 'Số sao phải từ 1 đến 5.',
            'binh_luan.string' => 'Bình luận phải là chuỗi ký tự.',
            'binh_luan.max' => 'Bình luận không được vượt quá 1000 ký tự.',
        ];
    }
}