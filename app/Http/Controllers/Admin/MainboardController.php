<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mainboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MainboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainboards = Mainboard::orderBy('id', 'desc')->paginate(10);
        return view('admin.mainboard.index', compact('mainboards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mainboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            // 'gia'      => 'nullable|numeric',
            // 'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên mainboard không được để trống.',
            'ten.string' => 'Tên mainboard phải là chuỗi ký tự.',
            'ten.max' => 'Tên mainboard không được vượt quá 255 ký tự.',
            // 'gia.numeric'    => 'Giá phải là số.',
            // 'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Mainboard::create($data);
        return redirect()->route('admin.mainboard.index')->with('message', 'Mainboard đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mainboard = Mainboard::findOrFail($id);
        return view('admin.mainboard.show', compact('mainboard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mainboard = Mainboard::findOrFail($id);
        return view('admin.mainboard.edit', compact('mainboard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mainboard = Mainboard::findOrFail($id);
        $data = $request->validate([
            'ten' => 'required|string|max:255',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên mainboard không được để trống.',
            'ten.string' => 'Tên mainboard phải là chuỗi ký tự.',
            'ten.max' => 'Tên mainboard không được vượt quá 255 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $mainboard->update($data);
        return redirect()->route('admin.mainboard.index')->with('message', 'Mainboard đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mainboard = Mainboard::findOrFail($id);
        $mainboard->delete();
        return redirect()->route('admin.mainboard.index')->with('message', 'Mainboard đã được xóa thành công.');
    }
    public function trash()
    {
        $mainboards = Mainboard::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.mainboard.trash', compact('mainboards'));
    }

    public function restore($id)
    {
        $mainboard = Mainboard::onlyTrashed()->findOrFail($id);
        $mainboard->restore();
        return redirect()->route('admin.mainboard.trash')->with('message', 'Đã khôi phục mainboard thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $mainboard = Mainboard::withTrashed()->findOrFail($id);
            if ($mainboard->sanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.mainboard.trash')->with('error', 'Không thể xóa mainboard vì có sản phẩm liên kết.');
            }
            $mainboard->forceDelete();
            DB::commit();
            return redirect()->route('admin.mainboard.trash')->with('message', 'Đã xóa vĩnh viễn mainboard thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa vĩnh viễn mainboard: ' . $e->getMessage());
            return redirect()->route('admin.mainboard.trash')->with('error', 'Đã xảy ra lỗi khi xóa vĩnh viễn mainboard: ' . $e->getMessage());
        }
    }
}
