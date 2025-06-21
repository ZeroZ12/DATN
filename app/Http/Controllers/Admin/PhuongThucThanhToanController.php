<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuongThucThanhToan; // Đảm bảo đã import Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PhuongThucThanhToanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PhuongThucThanhToan::orderBy('id', 'desc');

        // Logic để hiển thị bản ghi đã xóa mềm hoặc đang hoạt động
        if ($request->has('status')) {
            if ($request->status === 'deleted') {
                $query->onlyTrashed(); // Chỉ lấy các bản ghi đã xóa mềm
            } elseif ($request->status === 'all') {
                $query->withTrashed(); // Lấy tất cả (bao gồm cả đã xóa mềm)
            }
            // Mặc định (nếu không có status hoặc status không hợp lệ) sẽ chỉ lấy các bản ghi đang hoạt động (chưa xóa mềm)
        }

        $phuongThucThanhToans = $query->paginate(10);
        return view('admin.phuongthucthanhtoan.index', compact('phuongThucThanhToans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.phuongthucthanhtoan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:100',
            'mo_ta' => 'nullable|string',
            'hoat_dong' => 'required|boolean',
        ], [
            'ten.required' => 'Tên phương thức thanh toán không được để trống.',
            'ten.string' => 'Tên phương thức thanh toán phải là chuỗi ký tự.',
            'ten.max' => 'Tên phương thức thanh toán không được vượt quá 100 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
            'hoat_dong.required' => 'Trạng thái hoạt động không được để trống.',
            'hoat_dong.boolean' => 'Trạng thái hoạt động phải là giá trị Có hoặc Không.',
        ]);
        PhuongThucThanhToan::create($data);
        return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Để hiển thị bản ghi đã xóa mềm nếu cần
        $phuongThucThanhToan = PhuongThucThanhToan::withTrashed()->findOrFail($id);
        return view('admin.phuongthucthanhtoan.show', compact('phuongThucThanhToan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Để có thể chỉnh sửa bản ghi đã xóa mềm nếu cần
        $phuongThucThanhToan = PhuongThucThanhToan::withTrashed()->findOrFail($id);
        return view('admin.phuongthucthanhtoan.edit', compact('phuongThucThanhToan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lấy bản ghi bao gồm cả đã xóa mềm để đảm bảo có thể cập nhật
        $phuongThucThanhToan = PhuongThucThanhToan::withTrashed()->findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:100',
            'mo_ta' => 'nullable|string',
            'hoat_dong' => 'required|boolean',
        ], [
            'ten.required' => 'Tên phương thức thanh toán không được để trống.',
            'ten.string' => 'Tên phương thức thanh toán phải là chuỗi ký tự.',
            'ten.max' => 'Tên phương thức thanh toán không được vượt quá 100 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
            'hoat_dong.required' => 'Trạng thái hoạt động không được để trống.',
            'hoat_dong.boolean' => 'Trạng thái hoạt động phải là giá trị Có hoặc Không.',
        ]);
        $phuongThucThanhToan->update($data);
        return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $phuongThucThanhToan = PhuongThucThanhToan::findOrFail($id); // Chỉ tìm các bản ghi chưa xóa mềm để xóa mềm
        $phuongThucThanhToan->delete(); // Laravel's SoftDeletes will set deleted_at
        return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được xóa mềm thành công.');
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
        $phuongThucThanhToan = PhuongThucThanhToan::onlyTrashed()->findOrFail($id);
        $phuongThucThanhToan->restore(); // Laravel's SoftDeletes will set deleted_at to NULL
        return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được khôi phục thành công.');
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
        try{
            DB::beginTransaction();
            $phuongThucThanhToan = PhuongThucThanhToan::withTrashed()->findOrFail($id);
            if ($phuongThucThanhToan->donHangs()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.phuongthucthanhtoan.index')->with('error', 'Không thể xóa phương thức thanh toán này vì nó đang được sử dụng trong đơn hàng.');
            }
            $phuongThucThanhToan->forceDelete(); // Xóa vĩnh viễn bản ghi
            DB::commit();
            return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được xóa vĩnh viễn thành công.');
        }   catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa phương thức thanh toán: ' . $e->getMessage());
            return redirect()->route('admin.phuongthucthanhtoan.index')->with('error', 'Đã xảy ra lỗi khi xóa phương thức thanh toán: ' . $e->getMessage());
        }
    }
}
