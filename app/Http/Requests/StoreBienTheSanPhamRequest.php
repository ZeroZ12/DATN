<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreBienTheSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Đảm bảo rằng chỉ người dùng có quyền 'quan_tri' mới có thể thực hiện request này.
        return Auth::user() && Auth::user()->vai_tro === 'quan_tri';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Khi tạo biến thể mới thông qua route lồng ghép, id_product sẽ được truyền qua route model binding
        // và có thể truy cập thông qua $this->route('sanpham')->id
        $productId = $this->route('sanpham')->id;

        return [
            'id_ram' => [
                'required',
                'exists:rams,id',
                // Đảm bảo không trùng RAM và Ổ Cứng cho cùng một sản phẩm
                Rule::unique('bien_the_san_phams')->where(function ($query) use ($productId) {
                    return $query->where('id_product', $productId)
                                 ->where('id_o_cung', $this->input('id_o_cung'));
                })->whereNull('deleted_at') // Thêm điều kiện này để chỉ kiểm tra với các biến thể chưa bị xóa mềm
            ],
            'id_o_cung' => 'required|exists:o_cungs,id',
            // 'id_product' không cần validate ở đây vì nó được lấy từ route model binding
            // 'ma_bien_the' sẽ được sinh tự động trong controller
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0|lte:gia', // Add lte rule: giá so sánh không lớn hơn giá bán
            'ton_kho' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id_ram.required' => 'Vui lòng chọn RAM cho biến thể.',
            'id_ram.exists' => 'RAM được chọn không hợp lệ.',
            'id_ram.unique' => 'Biến thể với sự kết hợp RAM và Ổ cứng này đã tồn tại cho sản phẩm này.',
            'id_o_cung.required' => 'Vui lòng chọn Ổ cứng cho biến thể.',
            'id_o_cung.exists' => 'Ổ cứng được chọn không hợp lệ.',
            'gia.required' => 'Giá bán là bắt buộc.',
            'gia.numeric' => 'Giá bán phải là số.',
            'gia.min' => 'Giá bán không được âm.',
            'gia_so_sanh.numeric' => 'Giá so sánh phải là số.',
            'gia_so_sanh.min' => 'Giá so sánh không được âm.',
            'gia_so_sanh.lte' => 'Giá so sánh không được lớn hơn giá bán.',
            'ton_kho.required' => 'Tồn kho là bắt buộc.',
            'ton_kho.integer' => 'Tồn kho phải là số nguyên.',
            'ton_kho.min' => 'Tồn kho không được âm.',
            'anh_dai_dien.image' => 'Ảnh đại diện biến thể phải là định dạng ảnh hợp lệ.',
            'anh_dai_dien.mimes' => 'Ảnh đại diện biến thể phải có định dạng: jpeg, png, jpg, gif, svg.',
            'anh_dai_dien.max' => 'Ảnh đại diện biến thể không được vượt quá 2MB.',
        ];
    }
}
