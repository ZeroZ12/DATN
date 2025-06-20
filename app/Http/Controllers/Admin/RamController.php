<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rams = Ram::orderBy('id', 'desc')->paginate(10);
        return view('admin.ram.index', compact('rams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ram.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'dung_luong' => 'required|string|max:100',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'dung_luong.required' => 'Dung lượng RAM không được để trống.',
            'dung_luong.string' => 'Dung lượng RAM phải là chuỗi ký tự.',
            'dung_luong.max' => 'Dung lượng RAM không được vượt quá 100 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        Ram::create($data);
        return redirect()->route('admin.ram.index')->with('message', 'RAM đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ram = Ram::findOrFail($id);
        return view('admin.ram.show', compact('ram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ram = Ram::findOrFail($id);
        return view('admin.ram.edit', compact('ram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ram = Ram::findOrFail($id);
        $data = $request->validate([
            'dung_luong' => 'required|string|max:100',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'dung_luong.required' => 'Dung lượng RAM không được để trống.',
            'dung_luong.string' => 'Dung lượng RAM phải là chuỗi ký tự.',
            'dung_luong.max' => 'Dung lượng RAM không được vượt quá 100 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $ram->update($data);
        return redirect()->route('admin.ram.index')->with('message', 'RAM đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ram = Ram::findOrFail($id);
        $ram->delete();
        return redirect()->route('admin.ram.index')->with('message', 'RAM đã được xóa thành công.');
    }
    public function trash()
    {
        $rams = Ram::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.ram.trash', compact('rams'));
    }

    public function restore($id)
    {
        $ram = Ram::onlyTrashed()->findOrFail($id);
        $ram->restore();
        return redirect()->route('admin.ram.trash')->with('message', 'Đã khôi phục RAM thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $ram = Ram::withTrashed()->findOrFail($id);
            if ($ram->bienTheSanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.ram.trash')->with('error', 'Không thể xóa RAM vì có biến thể sản phẩm liên quan.');
            }
            $ram->forceDelete();
            DB::commit();
            return redirect()->route('admin.ram.trash')->with('message', 'RAM đã được xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ram.trash')->with('error', 'Đã xảy ra lỗi khi xóa RAM: ' . $e->getMessage());
        }
    }
}
