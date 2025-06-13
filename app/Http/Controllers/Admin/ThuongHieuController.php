<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuongHieu; 
use Illuminate\Http\Request;

class ThuongHieuController extends Controller
{

    public function index(Request $request)
    {
        $query = ThuongHieu::orderBy('id', 'desc');

        if ($request->has('status')) {
            if ($request->status === 'deleted') {
                $query->onlyTrashed(); 
            } elseif ($request->status === 'all') {
                $query->withTrashed(); 
            }
        }
        $thuongHieus = $query->paginate(10);
        return view('admin.thuonghieu.index', compact('thuongHieus'));
    }


    public function create()
    {
        return view('admin.thuonghieu.create');
    }

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


    public function show(string $id)
    {
        $thuongHieu = ThuongHieu::withTrashed()->findOrFail($id);
        return view('admin.thuonghieu.show', compact('thuongHieu'));
    }


    public function edit(string $id)
    {
        $thuongHieu = ThuongHieu::withTrashed()->findOrFail($id);
        return view('admin.thuonghieu.edit', compact('thuongHieu'));
    }

  
    public function update(Request $request, string $id)
    {
        $thuongHieu = ThuongHieu::withTrashed()->findOrFail($id);
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


    public function destroy(string $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id); 
        $thuongHieu->delete(); 
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được xóa mềm thành công.');
    }


    public function restore(string $id)
    {
        $thuongHieu = ThuongHieu::onlyTrashed()->findOrFail($id);
        $thuongHieu->restore(); 
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được khôi phục thành công.');
    }


    public function forceDelete(string $id)
    {
        $thuongHieu = ThuongHieu::onlyTrashed()->findOrFail($id); 
        $thuongHieu->forceDelete(); 
        return redirect()->route('admin.thuonghieu.index')->with('message', 'Thương hiệu đã được xóa vĩnh viễn.');
    }
}