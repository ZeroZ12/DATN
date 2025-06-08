<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chip;
use Illuminate\Http\Request;

class ChipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chips = Chip::orderBy('id', 'desc')->paginate(10);
        return view('admin.chip.index', compact('chips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chip.create');
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
            'ten.required' => 'Tên chip không được để trống.',
            'ten.string' => 'Tên chip phải là chuỗi ký tự.',
            'ten.max' => 'Tên chip không được vượt quá 255 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Chip::create($data);
        return redirect()->route('admin.chip.index')->with('message', 'Chip đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chip = Chip::findOrFail($id);
        return view('admin.chip.show', compact('chip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $chip = Chip::findOrFail($id);
        return view('admin.chip.edit', compact('chip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chip = Chip::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên chip không được để trống.',
            'ten.string' => 'Tên chip phải là chuỗi ký tự.',
            'ten.max' => 'Tên chip không được vượt quá 255 ký tự.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $chip->update($data);
        return redirect()->route('admin.chip.index')->with('message', 'Chip đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chip = Chip::findOrFail($id);
        $chip->delete();
        return redirect()->route('admin.chip.index')->with('message', 'Chip đã được xóa thành công.');
    }
}