<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;

class ThuongHieuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thuongHieus = ThuongHieu::orderBy('id', 'desc')->paginate(10);
        return view('admin.thuonghieu.index', compact('thuongHieus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.thuonghieu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
        ], [
            'ten.required' => 'Tên thương hiệu không được để trống.',
            'ten.string' => 'Tên thương hiệu phải là chuỗi ký tự.',
            'ten.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
        ]);
        ThuongHieu::create($data);
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.show', compact('thuongHieu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return view('admin.thuonghieu.edit', compact('thuongHieu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
        ], [
            'ten.required' => 'Tên thương hiệu không được để trống.',
            'ten.string' => 'Tên thương hiệu phải là chuỗi ký tự.',
            'ten.max' => 'Tên thương hiệu không được vượt quá 255 ký tự.',
        ]);
        $thuongHieu->update($data);
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        $thuongHieu->delete();
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được xóa thành công.');
    }
}