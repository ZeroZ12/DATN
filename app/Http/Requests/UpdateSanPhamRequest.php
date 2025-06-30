<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateSanPhamRequest extends FormRequest
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
        // Lấy ID sản phẩm từ route
        $sanPhamId = $this->route('sanpham'); // 'sanpham' là tên tham số trong route resource

        return [
            'ten' => 'required|string|max:255',
            'ma_san_pham' => [
                'nullable',
                'string',
                'max:255',
                // Quy tắc unique: bỏ qua chính id hiện tại đang update
                Rule::unique('san_phams', 'ma_san_pham')->ignore($sanPhamId),
            ],
            'mo_ta' => 'nullable|string',
            'id_category' => 'required|exists:danh_mucs,id',
            'id_brand' => 'required|exists:thuong_hieus,id',
            'id_chip' => 'required|exists:chips,id',
            'id_mainboard' => 'required|exists:mainboards,id',
            'id_gpu' => 'required|exists:gpus,id',
            'id_case' => 'nullable|exists:cases,id',
            'id_tannhiet' => 'nullable|exists:tan_nhiets,id',
            'id_nguon' => 'nullable|exists:nguons,id',
            'bao_hanh_thang' => 'nullable|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'anh_phu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'xoa_anh_phu' => 'nullable|array',
            'xoa_anh_phu.*' => 'exists:anh_san_phams,id', // Sửa lại tên bảng nếu cần, theo schema của bạn là 'anh_san_phams'

            // Validation cho các biến thể
            'variants' => 'array', // variants có thể không có nếu xóa hết
            'variants.*.id' => 'nullable|exists:bien_the_san_phams,id',
            'variants.*.ram_id' => 'required|exists:rams,id',
            'variants.*.o_cung_id' => 'required|exists:o_cungs,id',
            'variants.*.gia' => 'required|numeric|min:0',
            'variants.*.gia_so_sanh' => 'nullable|numeric|min:0',
            'variants.*.ton_kho' => 'required|integer|min:0',
            'variants.*.anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'xoa_bien_the' => 'nullable|array',
            'xoa_bien_the.*' => 'exists:bien_the_san_phams,id',
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
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'id_category.required' => 'Vui lòng chọn danh mục.',
            'id_category.exists' => 'Danh mục được chọn không hợp lệ.',
            'id_brand.required' => 'Vui lòng chọn thương hiệu.',
            'id_brand.exists' => 'Thương hiệu được chọn không hợp lệ.',
            'id_chip.exists' => 'Chip được chọn không hợp lệ.',
            'id_mainboard.exists' => 'Mainboard được chọn không hợp lệ.',
            'id_gpu.exists' => 'GPU được chọn không hợp lệ.',
            'bao_hanh_thang.integer' => 'Thời gian bảo hành phải là số nguyên.',
            'bao_hanh_thang.min' => 'Thời gian bảo hành không được âm.',
            'anh_dai_dien.image' => 'Ảnh đại diện phải là định dạng ảnh hợp lệ.',
            'anh_dai_dien.max' => 'Ảnh đại diện không được vượt quá 2MB.',
            'anh_phu.*.image' => 'Ảnh phụ phải là định dạng ảnh hợp lệ.',
            'anh_phu.*.max' => 'Ảnh phụ không được vượt quá 2MB.',
            'xoa_anh_phu.*.exists' => 'ID ảnh phụ cần xóa không tồn tại.',

            'variants.*.ram_id.required' => 'Biến thể phải có RAM.',
            'variants.*.ram_id.exists' => 'RAM được chọn cho biến thể không hợp lệ.',
            'variants.*.o_cung_id.required' => 'Biến thể phải có Ổ cứng.',
            'variants.*.o_cung_id.exists' => 'Ổ cứng được chọn cho biến thể không hợp lệ.',
            'variants.*.gia.required' => 'Giá biến thể là bắt buộc.',
            'variants.*.gia.numeric' => 'Giá biến thể phải là số.',
            'variants.*.gia.min' => 'Giá biến thể không được âm.',
            'variants.*.gia_so_sanh.numeric' => 'Giá so sánh phải là số.',
            'variants.*.gia_so_sanh.min' => 'Giá so sánh không được âm.',
            'variants.*.ton_kho.required' => 'Tồn kho biến thể là bắt buộc.',
            'variants.*.ton_kho.integer' => 'Tồn kho biến thể phải là số nguyên.',
            'variants.*.ton_kho.min' => 'Tồn kho biến thể không được âm.',
            'variants.*.anh_dai_dien.image' => 'Ảnh biến thể phải là định dạng ảnh hợp lệ.',
            'variants.*.anh_dai_dien.max' => 'Ảnh biến thể không được vượt quá 2MB.',
            'xoa_bien_the.*.exists' => 'ID biến thể cần xóa không tồn tại.',
        ];
    }

    /**
     * Validate thủ công: Giá so sánh phải lớn hơn giá bán (giá_so_sanh > gia).
     * Nếu giá so sánh nhỏ hơn hoặc bằng giá bán thì báo lỗi.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $variants = $this->input('variants', []);
            foreach ($variants as $i => $variant) {
                $gia = isset($variant['gia']) ? floatval($variant['gia']) : 0;
                $giaSoSanh = isset($variant['gia_so_sanh']) ? floatval($variant['gia_so_sanh']) : null;
                if ($giaSoSanh !== null && $giaSoSanh <= $gia) {
                    $validator->errors()->add("variants.$i.gia_so_sanh", "Giá so sánh phải lớn hơn giá bán.");
                }
            }
        });
    }
}
