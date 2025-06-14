<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateBienTheSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return Auth::user() && Auth::user()->vai_tro === 'quan_tri';
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Lấy ID sản phẩm và biến thể từ route parameters để bỏ qua khi kiểm tra unique
        $sanPhamId = $this->route('sanpham')->id;
        $bientheId = $this->route('bienthe')->id;

        return [
            'id_ram' => [
                'required',
                'exists:rams,id',
                // Đảm bảo không trùng RAM và Ổ Cứng cho cùng một sản phẩm, bỏ qua biến thể hiện tại
                Rule::unique('bien_the_san_phams')->where(function ($query) use ($sanPhamId) {
                    return $query->where('id_product', $sanPhamId)
                                 ->where('id_o_cung', $this->input('id_o_cung'));
                })->ignore($bientheId)->whereNull('deleted_at') // Bỏ qua biến thể hiện tại và chỉ kiểm tra các biến thể chưa xóa mềm
            ],
            'id_o_cung' => 'required|exists:o_cungs,id',
            // 'ma_bien_the' không cần validate unique ở đây vì nó không thay đổi khi update
            // Nếu bạn cho phép sửa mã biến thể, hãy thêm lại Rule::unique ở đây.
            'gia' => 'required|numeric|min:0',
            'gia_so_sanh' => 'nullable|numeric|min:0|lte:gia',
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
