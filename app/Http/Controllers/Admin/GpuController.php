<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gpu;
use Illuminate\Http\Request;

class GpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gpus = Gpu::orderBy('id', 'desc')->paginate(10);
        return view('admin.gpu.index', compact('gpus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gpu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên GPU không được để trống.',
            'ten.string' => 'Tên GPU phải là chuỗi ký tự.',
            'ten.max' => 'Tên GPU không được vượt quá 255 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Gpu::create($data);
        return redirect()->route('admin.gpu.index')->with('message', 'GPU đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gpu = Gpu::findOrFail($id);
        return view('admin.gpu.show', compact('gpu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gpu = Gpu::findOrFail($id);
        return view('admin.gpu.edit', compact('gpu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gpu = Gpu::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên GPU không được để trống.',
            'ten.string' => 'Tên GPU phải là chuỗi ký tự.',
            'ten.max' => 'Tên GPU không được vượt quá 255 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $gpu->update($data);
        return redirect()->route('admin.gpu.index')->with('message', 'GPU đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gpu = Gpu::findOrFail($id);
        $gpu->delete();
        return redirect()->route('admin.gpu.index')->with('message', 'GPU đã được xóa thành công.');
    }
    public function trash()
{
    $gpus = Gpu::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
    return view('admin.gpu.trash', compact('gpus'));
}

public function restore($id)
{
    $gpu = Gpu::onlyTrashed()->findOrFail($id);
    $gpu->restore();
    return redirect()->route('admin.gpu.trash')->with('message', 'Đã khôi phục GPU thành công.');
}

public function forceDelete($id)
{
    $gpu = Gpu::onlyTrashed()->findOrFail($id);
    $gpu->forceDelete();
    return redirect()->route('admin.gpu.trash')->with('message', 'Đã xóa vĩnh viễn GPU.');
}
}
