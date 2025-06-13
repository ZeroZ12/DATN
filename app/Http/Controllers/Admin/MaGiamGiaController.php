<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaGiamGia; // Đảm bảo đã import Model
use Illuminate\Http\Request;

class MaGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MaGiamGia::orderBy('id', 'desc');

        // Logic để hiển thị bản ghi đã xóa mềm hoặc đang hoạt động
        if ($request->has('status')) {
            if ($request->status === 'deleted') {
                $query->onlyTrashed(); // Chỉ lấy các bản ghi đã xóa mềm
            } elseif ($request->status === 'all') {
                $query->withTrashed(); // Lấy tất cả (bao gồm cả đã xóa mềm)
            }
            // Mặc định (nếu không có status hoặc status không hợp lệ) sẽ chỉ lấy các bản ghi đang hoạt động (chưa xóa mềm)
        }

        $maGiamGias = $query->paginate(10);
        return view('admin.magiamgia.index', compact('maGiamGias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.magiamgia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ma' => 'required|string|max:50|unique:ma_giam_gias,ma',
            'loai' => 'required|in:phan_tram,tien_mat',
            'gia_tri' => 'required|numeric|min:0',
            'ngay_bat_dau' => 'nullable|date',
            'ngay_ket_thuc' => 'nullable|date|after_or_equal:ngay_bat_dau',
            'hoat_dong' => 'required|boolean',
        ], [
            'ma.required' => 'Mã giảm giá không được để trống.',
            'ma.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'ma.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'ma.unique' => 'Mã giảm giá đã tồn tại.',
            'loai.required' => 'Loại mã giảm giá không được để trống.',
            'loai.in' => 'Loại mã giảm giá phải là "Phần trăm" hoặc "Tiền mặt".',
            'gia_tri.required' => 'Giá trị mã giảm giá không được để trống.',
            'gia_tri.numeric' => 'Giá trị mã giảm giá phải là số.',
            'gia_tri.min' => 'Giá trị mã giảm giá phải lớn hơn hoặc bằng 0.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'hoat_dong.required' => 'Trạng thái hoạt động không được để trống.',
            'hoat_dong.boolean' => 'Trạng thái hoạt động phải là giá trị Có hoặc Không.',
        ]);
        MaGiamGia::create($data);
        return redirect()->route('admin.magiamgia.index')->with('message', 'Mã giảm giá đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Để hiển thị bản ghi đã xóa mềm nếu cần
        $maGiamGia = MaGiamGia::withTrashed()->findOrFail($id);
        return view('admin.magiamgia.show', compact('maGiamGia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Để có thể chỉnh sửa bản ghi đã xóa mềm nếu cần
        $maGiamGia = MaGiamGia::withTrashed()->findOrFail($id);
        return view('admin.magiamgia.edit', compact('maGiamGia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lấy bản ghi bao gồm cả đã xóa mềm để đảm bảo có thể cập nhật
        $maGiamGia = MaGiamGia::withTrashed()->findOrFail($id);
        $data = $request->validate([
            'ma' => 'required|string|max:50|unique:ma_giam_gias,ma,' . $id,
            'loai' => 'required|in:phan_tram,tien_mat',
            'gia_tri' => 'required|numeric|min:0',
            'ngay_bat_dau' => 'nullable|date',
            'ngay_ket_thuc' => 'nullable|date|after_or_equal:ngay_bat_dau',
            'hoat_dong' => 'required|boolean',
        ], [
            'ma.required' => 'Mã giảm giá không được để trống.',
            'ma.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'ma.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'ma.unique' => 'Mã giảm giá đã tồn tại.',
            'loai.required' => 'Loại mã giảm giá không được để trống.',
            'loai.in' => 'Loại mã giảm giá phải là "Phần trăm" hoặc "Tiền mặt".',
            'gia_tri.required' => 'Giá trị mã giảm giá không được để trống.',
            'gia_tri.numeric' => 'Giá trị mã giảm giá phải là số.',
            'gia_tri.min' => 'Giá trị mã giảm giá phải lớn hơn hoặc bằng 0.',
            'ngay_bat_dau.date' => 'Ngày bắt đầu phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.date' => 'Ngày kết thúc phải là định dạng ngày hợp lệ.',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'hoat_dong.required' => 'Trạng thái hoạt động không được để trống.',
            'hoat_dong.boolean' => 'Trạng thái hoạt động phải là giá trị Có hoặc Không.',
        ]);
        $maGiamGia->update($data);
        return redirect()->route('admin.magiamgia.index')->with('message', 'Mã giảm giá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $maGiamGia = MaGiamGia::findOrFail($id); // Chỉ tìm các bản ghi chưa xóa mềm để xóa mềm
        $maGiamGia->delete(); // Laravel's SoftDeletes will set deleted_at
        return redirect()->route('admin.magiamgia.index')->with('message', 'Mã giảm giá đã được xóa mềm thành công.');
    }

    /**
     * Restore the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(string $id)
    {
        // Tìm bản ghi đã xóa mềm để khôi phục
        $maGiamGia = MaGiamGia::onlyTrashed()->findOrFail($id);
        $maGiamGia->restore(); // Laravel's SoftDeletes will set deleted_at to NULL
        return redirect()->route('admin.magiamgia.index')->with('message', 'Mã giảm giá đã được khôi phục thành công.');
    }

    /**
     * Force delete the specified resource from storage (Permanent Delete).
     * Chỉ dùng khi bạn muốn xóa vĩnh viễn khỏi CSDL
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(string $id)
    {
        $maGiamGia = MaGiamGia::onlyTrashed()->findOrFail($id); // Chỉ tìm trong số đã xóa mềm
        $maGiamGia->forceDelete(); // Xóa vĩnh viễn khỏi CSDL
        return redirect()->route('admin.magiamgia.index')->with('message', 'Mã giảm giá đã được xóa vĩnh viễn.');
    }
}
