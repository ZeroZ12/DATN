<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaGiamGiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ma' => 'required|string|max:50|unique:ma_giam_gias,ma',
            'loai' => 'required|in:phan_tram,tien_mat',
            'so_luong' => 'required|integer|min:0',
            'gia_tri' => 'required|numeric|min:0|max:99999999',
            'gia_tri_toi_da' => 'required|numeric|min:0|max:99999999',
            'dieu_kien' => 'nullable|numeric|min:0|max:99999999',
            'ngay_bat_dau' => 'nullable|date',
            'ngay_ket_thuc' => 'nullable|date|after_or_equal:ngay_bat_dau',
            'hoat_dong' => 'required|boolean',
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
            'ma.required' => 'Mã giảm giá không được để trống.',
            'ma.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'ma.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'ma.unique' => 'Mã giảm giá đã tồn tại.',
            'loai.required' => 'Loại mã giảm giá không được để trống.',
            'loai.in' => 'Loại mã giảm giá phải là "Phần trăm" hoặc "Tiền mặt".',
            'so_luong.required' => 'Số lượng không được để trống.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'gia_tri.required' => 'Giá trị mã giảm giá không được để trống.',
            'gia_tri.numeric' => 'Giá trị mã giảm giá phải là số.',
            'gia_tri.min' => 'Giá trị mã giảm giá phải lớn hơn hoặc bằng 0.',
            'gia_tri.max' => 'Giá trị mã giảm giá không được vượt quá 99,999,999.',
            'gia_tri_toi_da.required' => 'Giá trị tối đa không được để trống.',
            'gia_tri_toi_da.numeric' => 'Giá trị tối đa phải là số.',
            'gia_tri_toi_da.min' => 'Giá trị tối đa phải lớn hơn hoặc bằng 0.',
            'gia_tri_toi_da.max' => 'Giá trị tối đa không được vượt quá 99,999,999.',
            'dieu_kien.numeric' => 'Điều kiện áp dụng phải là số.',
            'dieu_kien.min' => 'Điều kiện áp dụng phải lớn hơn hoặc bằng 0.',
            'dieu_kien.max' => 'Điều kiện áp dụng không được vượt quá 99,999,999.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'hoat_dong.required' => 'Trạng thái hoạt động không được để trống.',
            'hoat_dong.boolean' => 'Trạng thái hoạt động phải là giá trị Có hoặc Không.',
        ];
    }
}
