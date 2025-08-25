<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TanNhiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanNhietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $TanNhiets = TanNhiet::orderBy('id', 'desc')->paginate(10);
        return view('admin.tannhiet.index', compact('TanNhiets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tannhiet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255|unique:tan_nhiets,ten',
            'gia'      => 'nullable|numeric|digits_between:1,12',
            'gia_sale' => 'nullable|numeric|digits_between:1,12',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên tản nhiệt không được để trống.',
            'ten.string' => 'Tên tản nhiệt phải là chuỗi ký tự.',
            'ten.max' => 'Tên tản nhiệt không được vượt quá 255 ký tự.',
            'ten.unique' => 'Tên tản nhiệt đã tồn tại.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia.digits_between' => 'Giá không được vượt quá 12 chữ số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'gia_sale.digits_between' => 'Giá sale không được vượt quá 12 chữ số.', 
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        TanNhiet::create($data);
        return redirect()->route('admin.tannhiet.index')->with('message', 'Tản nhiệt đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $TanNhiet = TanNhiet::findOrFail($id);
        return view('admin.tannhiet.show', compact('TanNhiet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $TanNhiet = TanNhiet::findOrFail($id);
        return view('admin.tannhiet.edit', compact('TanNhiet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $TanNhiet = TanNhiet::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255|unique:tan_nhiets,ten',
            'gia'      => 'nullable|numeric|digits_between:1,12',
            'gia_sale' => 'nullable|numeric|digits_between:1,12',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên tản nhiệt không được để trống.',
            'ten.string' => 'Tên tản nhiệt phải là chuỗi ký tự.',
            'ten.max' => 'Tên tản nhiệt không được vượt quá 255 ký tự.',
            'ten.unique' => 'Tên tản nhiệt đã tồn tại.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia.digits_between' => 'Giá không được vượt quá 12 chữ số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'gia_sale.digits_between' => 'Giá sale không được vượt quá 12 chữ số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $TanNhiet->update($data);
        return redirect()->route('admin.tannhiet.index')->with('message', 'tản nhiệt đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $TanNhiet = TanNhiet::findOrFail($id);
        $TanNhiet->delete();
        return redirect()->route('admin.tannhiet.index')->with('message', 'tản nhiệt đã được xóa thành công.');
    }
    public function trash()
    {
        $TanNhiets = TanNhiet::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.tannhiet.trash', compact('TanNhiets'));
    }

    public function restore($id)
    {
        $TanNhiet = TanNhiet::onlyTrashed()->findOrFail($id);
        $TanNhiet->restore();
        return redirect()->route('admin.tannhiet.trash')->with('message', 'Đã khôi phục tản nhiệt thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $TanNhiet = TanNhiet::withTrashed()->findOrFail($id);
            if ($TanNhiet->bienTheSanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.tannhiet.trash')->with('error', 'Không thể xóa tản nhiệt này vì nó có biến thể sản phẩm liên quan.');
            }
            $TanNhiet->forceDelete();
            DB::commit();
            return redirect()->route('admin.tannhiet.trash')->with('message', 'Đã xóa vĩnh viễn tản nhiệt thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.tannhiet.trash')->with('error', 'Đã xảy ra lỗi khi xóa tản nhiệt: ' . $e->getMessage());
        }
    }
}
