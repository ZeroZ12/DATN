<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases = Cases::orderBy('id', 'desc')->paginate(10);
        return view('admin.case.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.case.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên Case không được để trống.',
            'ten.string' => 'Tên Case phải là chuỗi ký tự.',
            'ten.max' => 'Tên Case không được vượt quá 255 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Cases::create($data);
        return redirect()->route('admin.case.index')->with('message', 'Case đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cases = Cases::findOrFail($id);
        return view('admin.case.show', compact('cases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cases = Cases::findOrFail($id);
        return view('admin.case.edit', compact('cases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cases = Cases::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên Case không được để trống.',
            'ten.string' => 'Tên Case phải là chuỗi ký tự.',
            'ten.max' => 'Tên Case không được vượt quá 255 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $cases->update($data);
        return redirect()->route('admin.case.index')->with('message', 'Case đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cases = Cases::findOrFail($id);
        $cases->delete();
        return redirect()->route('admin.case.index')->with('message', 'Case đã được xóa thành công.');
    }
    public function trash()
    {
        $cases = Cases::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.case.trash', compact('cases'));
    }

    public function restore($id)
    {
        $cases = Cases::onlyTrashed()->findOrFail($id);
        $cases->restore();
        return redirect()->route('admin.case.trash')->with('message', 'Đã khôi phục Case thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $cases = Cases::withTrashed()->findOrFail($id);
            if ($cases->bienTheSanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.case.trash')->with('error', 'Không thể xóa Case này vì nó có biến thể sản phẩm liên quan.');
            }
            $cases->forceDelete();
            DB::commit();
            return redirect()->route('admin.case.trash')->with('message', 'Đã xóa vĩnh viễn Case thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.case.trash')->with('error', 'Đã xảy ra lỗi khi xóa Case: ' . $e->getMessage());
        }
    }
}
