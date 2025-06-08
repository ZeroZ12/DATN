<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhuongThucThanhToan;
use Illuminate\Http\Request;

class PhuongThucThanhToanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phuongThucThanhToans = PhuongThucThanhToan::orderBy('id', 'desc')->paginate(10);
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
        $phuongThucThanhToan = PhuongThucThanhToan::findOrFail($id);
        return view('admin.phuongthucthanhtoan.show', compact('phuongThucThanhToan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $phuongThucThanhToan = PhuongThucThanhToan::findOrFail($id);
        return view('admin.phuongthucthanhtoan.edit', compact('phuongThucThanhToan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $phuongThucThanhToan = PhuongThucThanhToan::findOrFail($id);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phuongThucThanhToan = PhuongThucThanhToan::findOrFail($id);
        $phuongThucThanhToan->delete();
        return redirect()->route('admin.phuongthucthanhtoan.index')->with('message', 'Phương thức thanh toán đã được xóa thành công.');
    }
}