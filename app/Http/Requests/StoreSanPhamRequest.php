<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Đảm bảo rằng chỉ người dùng có quyền 'quan_tri' mới có thể thực hiện request này.
        // Hoặc bạn có thể quản lý quyền hạn ở middleware.
        return Auth::user() && Auth::user()->vai_tro === 'quan_tri';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'id_chip' => 'required|exists:chips,id',
            'id_mainboard' => 'required|exists:mainboards,id',
            'id_gpu' => 'required|exists:gpus,id',
            'id_category' => 'required|exists:danh_mucs,id',
            'id_brand' => 'required|exists:thuong_hieus,id',
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|max:2048', // Quy tắc cho ảnh chính
            'anh_phu.*' => 'nullable|image|max:2048',    // Quy tắc cho từng ảnh phụ trong mảng
            'variants' => 'required|array', // variants là bắt buộc và phải là mảng
            'variants.*.ram_id' => 'required|exists:rams,id',
            'variants.*.o_cung_id' => 'required|exists:o_cungs,id',
            'variants.*.gia' => 'required|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0|lte:variants.*.gia', // gia_so_sanh <= gia
            'variants.*.ton_kho' => 'required|integer|min:0',
            'variants.*.anh_dai_dien' => 'nullable|image|max:2048', // Ảnh cho từng biến thể
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
            'ten.required' => 'Tên sản phẩm là bắt buộc.',
            'ten.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'id_chip.required' => 'Vui lòng chọn Chip.',
            'id_chip.exists' => 'Chip được chọn không hợp lệ.',
            'id_mainboard.required' => 'Vui lòng chọn Mainboard.',
            'id_mainboard.exists' => 'Mainboard được chọn không hợp lệ.',
            'id_gpu.required' => 'Vui lòng chọn GPU.',
            'id_gpu.exists' => 'GPU được chọn không hợp lệ.',
            'id_category.required' => 'Vui lòng chọn Danh mục.',
            'id_category.exists' => 'Danh mục được chọn không hợp lệ.',
            'id_brand.required' => 'Vui lòng chọn Thương hiệu.',
            'id_brand.exists' => 'Thương hiệu được chọn không hợp lệ.',
            'bao_hanh_thang.integer' => 'Thời gian bảo hành phải là số nguyên.',
            'bao_hanh_thang.min' => 'Thời gian bảo hành không được âm.',
            'anh_dai_dien.image' => 'Ảnh đại diện phải là định dạng ảnh hợp lệ.',
            'anh_dai_dien.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'anh_phu.*.image' => 'Ảnh phụ phải là định dạng ảnh hợp lệ.',
            'anh_phu.*.max' => 'Ảnh phụ không được vượt quá 2MB.',
            'variants.required' => 'Sản phẩm phải có ít nhất một biến thể.',
            'variants.array' => 'Dữ liệu biến thể không hợp lệ.',
            'variants.*.ram_id.required' => 'Biến thể phải có RAM.',
            'variants.*.ram_id.exists' => 'RAM được chọn cho biến thể không hợp lệ.',
            'variants.*.o_cung_id.required' => 'Biến thể phải có Ổ cứng.',
            'variants.*.o_cung_id.exists' => 'Ổ cứng được chọn cho biến thể không hợp lệ.',
            'variants.*.gia.required' => 'Giá biến thể là bắt buộc.',
            'variants.*.gia.numeric' => 'Giá biến thể phải là số.',
            'variants.*.gia.min' => 'Giá biến thể không được âm.',
            'variants.*.gia_so_sanh.numeric' => 'Giá so sánh phải là số.',
            'variants.*.gia_so_sanh.min' => 'Giá so sánh không được âm.',
            'variants.*.gia_so_sanh.lte' => 'Giá so sánh không được lớn hơn giá bán.',
            'variants.*.ton_kho.required' => 'Tồn kho biến thể là bắt buộc.',
            'variants.*.ton_kho.integer' => 'Tồn kho biến thể phải là số nguyên.',
            'variants.*.ton_kho.min' => 'Tồn kho biến thể không được âm.',
            'variants.*.anh_dai_dien.image' => 'Ảnh biến thể phải là định dạng ảnh hợp lệ.',
            'variants.*.anh_dai_dien.max' => 'Ảnh biến thể không được vượt quá 2MB.',
        ];
    }
}
