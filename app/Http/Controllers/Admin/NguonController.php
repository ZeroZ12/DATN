<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nguon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NguonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nguons = Nguon::orderBy('id', 'desc')->paginate(10);
        return view('admin.nguon.index', compact('nguons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.nguon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'gia'      => 'nullable|numeric|digits_between:1,12',
            'gia_sale' => 'nullable|numeric|digits_between:1,12',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên nguồn không được để trống.',
            'ten.string' => 'Tên nguồn phải là chuỗi ký tự.',
            'ten.max' => 'Tên nguồn không được vượt quá 255 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia.digits_between' => 'Giá không được vượt quá 12 chữ số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'gia_sale.digits_between' => 'Giá sale không được vượt quá 12 chữ số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Nguon::create($data);
        return redirect()->route('admin.nguon.index')->with('message', 'Nguồn đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nguon = Nguon::findOrFail($id);
        return view('admin.nguon.show', compact('nguon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nguon = Nguon::findOrFail($id);
        return view('admin.nguon.edit', compact('nguon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nguon = Nguon::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'gia'      => 'nullable|numeric|digits_between:1,12',
            'gia_sale' => 'nullable|numeric|digits_between:1,12',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên nguồn không được để trống.',
            'ten.string' => 'Tên nguồn phải là chuỗi ký tự.',
            'ten.max' => 'Tên nguồn không được vượt quá 255 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia.digits_between' => 'Giá không được vượt quá 12 chữ số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'gia_sale.digits_between' => 'Giá sale không được vượt quá 12 chữ số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $nguon->update($data);
        return redirect()->route('admin.nguon.index')->with('message', 'Nguồn đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nguon = Nguon::findOrFail($id);
        $nguon->delete();
        return redirect()->route('admin.nguon.index')->with('message', 'Nguồn đã được xóa thành công.');
    }
    public function trash()
    {
        $nguons = Nguon::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.nguon.trash', compact('nguons'));
    }

    public function restore($id)
    {
        $nguon = Nguon::onlyTrashed()->findOrFail($id);
        $nguon->restore();
        return redirect()->route('admin.nguon.trash')->with('message', 'Đã khôi phục Nguồn thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $nguon = Nguon::withTrashed()->findOrFail($id);
            if ($nguon->bienTheSanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.nguon.trash')->with('error', 'Không thể xóa Nguồn này vì nó có biến thể sản phẩm liên quan.');
            }
            $nguon->forceDelete();
            DB::commit();
            return redirect()->route('admin.nguon.trash')->with('message', 'Đã xóa vĩnh viễn Nguồn thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.nguon.trash')->with('error', 'Đã xảy ra lỗi khi xóa Nguồn: ' . $e->getMessage());
        }
    }
}
