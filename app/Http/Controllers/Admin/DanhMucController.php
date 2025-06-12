<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhmucs = DanhMuc::orderBy('id', 'desc')->paginate(10);
        return view('admin.danhmuc.index', compact('danhmucs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.danhmuc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
        ]);
        DanhMuc::create($data);
        return redirect()->route('admin.danhmuc.index')->with('message', 'Danh mục đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $danhmuc = DanhMuc::findOrFail($id);
    $sanphams = $danhmuc->sanPhams; // Lấy các sản phẩm thuộc danh mục

    return view('danhmuc.show', compact('danhmuc', 'sanphams'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.edit', compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
        ]);
        $danhmuc->update($data);
        return redirect()->route('admin.danhmuc.index')->with('message', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhmuc = DanhMuc::findOrFail($id);
        $danhmuc->delete();
        return redirect()->route('admin.danhmuc.index')->with('message', 'Danh mục đã được xóa thành công.');
    }
}
