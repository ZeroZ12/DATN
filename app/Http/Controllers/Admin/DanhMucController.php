<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\SanPham; // Thêm dòng này để sử dụng Model SanPham
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Chỉ lấy các danh mục chưa bị xóa mềm
        $ddanhmucs = DanhMuc::orderBy('id', 'desc')->paginate(10);
        return view('admin.danhmuc.index', compact('ddanhmucs'));
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
    public function show(string $id)
    {

        $danhmuc = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.show', compact('danhmuc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tương tự show, findOrFail sẽ bỏ qua bản ghi đã xóa mềm.
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

        SanPham::where('id_category', $id)->delete();

        return redirect()->route('admin.danhmuc.index')->with('message', 'Danh mục và các sản phẩm liên quan đã được xóa mềm thành công.');
    }


    /**
     * Display a listing of trashed resources.
     */
    public function trashed()
    {

        $Danhmucs = DanhMuc::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.danhmuc.trashed', compact('Danhmucs'));
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(string $id)
    {
        $danhmuc = DanhMuc::withTrashed()->findOrFail($id);
        $danhmuc->restore();

        SanPham::withTrashed()->where('id_category', $id)->restore();

        return redirect()->route('admin.danhmuc.index')->with('message', 'Danh mục và các sản phẩm liên quan đã được khôi phục thành công.');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function forceDelete(string $id)
    {
        $danhmuc = DanhMuc::withTrashed()->findOrFail($id);

        SanPham::withTrashed()->where('id_category', $id)->forceDelete();

        $danhmuc->forceDelete(); // Thực hiện xóa vật lý

        return redirect()->route('admin.danhmuc.trashed')->with('message', 'Danh mục và các sản phẩm liên quan đã được xóa vĩnh viễn.');
    }
}
