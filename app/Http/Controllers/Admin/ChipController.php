<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            // 'gia'      => 'nullable|numeric',
            // 'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên chip không được để trống.',
            'ten.string' => 'Tên chip phải là chuỗi ký tự.',
            'ten.max' => 'Tên chip không được vượt quá 255 ký tự.',
            // 'gia.numeric'    => 'Giá phải là số.',
            // 'gia_sale.numeric' => 'Giá sale phải là số.',
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
            // 'gia'      => 'nullable|numeric',
            // 'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'ten.required' => 'Tên chip không được để trống.',
            'ten.string' => 'Tên chip phải là chuỗi ký tự.',
            'ten.max' => 'Tên chip không được vượt quá 255 ký tự.',
            // 'gia.numeric'    => 'Giá phải là số.',
            // 'gia_sale.numeric' => 'Giá sale phải là số.',
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
    /**
     * Hiển thị danh sách Chip đã bị xóa mềm
     */
    public function trash()
    {
        $chips = Chip::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.chip.trash', compact('chips'));
    }

    /**
     * Khôi phục 1 chip đã xóa mềm
     */
    public function restore($id)
    {
        $chip = Chip::onlyTrashed()->findOrFail($id);
        $chip->restore();
        return redirect()->route('admin.chip.trash')->with('message', 'Đã khôi phục chip thành công.');
    }

    /**
     * Xóa vĩnh viễn 1 chip
     */
    public function forceDelete(string $id)
    {
        try {
            DB::beginTransaction();

            $chip = Chip::withTrashed()->findOrFail($id);
            if ($chip->sanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.chip.trash')->with('error', 'Không thể xóa chip này vì nó đang được sử dụng trong sản phẩm.');
            }


            $chip->forceDelete();

            DB::commit();
            return redirect()->route('admin.chips.index')->with('success', 'Chip đã được xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xóa vĩnh viễn chip: ' . $e->getMessage(), [
                'chip_id' => $id,
                'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi xóa vĩnh viễn chip: ' . $e->getMessage()]);
        }
    }
}
