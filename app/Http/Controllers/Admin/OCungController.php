<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OCung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OCungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $oCungs = OCung::orderBy('id', 'desc')->paginate(10);
        return view('admin.ocung.index', compact('oCungs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ocung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'loai' => 'required|string|max:50',
            'dung_luong' => 'required|string|max:100',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'loai.required' => 'Loại ổ cứng không được để trống.',
            'loai.string' => 'Loại ổ cứng phải là chuỗi ký tự.',
            'loai.max' => 'Loại ổ cứng không được vượt quá 50 ký tự.',
            'dung_luong.required' => 'Dung lượng ổ cứng không được để trống.',
            'dung_luong.string' => 'Dung lượng ổ cứng phải là chuỗi ký tự.',
            'dung_luong.max' => 'Dung lượng ổ cứng không được vượt quá 100 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        OCung::create($data);
        return redirect()->route('admin.ocung.index')->with('message', 'Ổ cứng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $oCung = OCung::findOrFail($id);
        return view('admin.ocung.show', compact('oCung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $oCung = OCung::findOrFail($id);
        return view('admin.ocung.edit', compact('oCung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oCung = OCung::findOrFail($id);
        $data = $request->validate([
            'loai' => 'required|string|max:50',
            'dung_luong' => 'required|string|max:100',
            'gia'      => 'nullable|numeric',
            'gia_sale' => 'nullable|numeric',
            'mo_ta' => 'nullable|string',
        ], [
            'loai.required' => 'Loại ổ cứng không được để trống.',
            'loai.string' => 'Loại ổ cứng phải là chuỗi ký tự.',
            'loai.max' => 'Loại ổ cứng không được vượt quá 50 ký tự.',
            'dung_luong.required' => 'Dung lượng ổ cứng không được để trống.',
            'dung_luong.string' => 'Dung lượng ổ cứng phải là chuỗi ký tự.',
            'dung_luong.max' => 'Dung lượng ổ cứng không được vượt quá 100 ký tự.',
            'gia.numeric'    => 'Giá phải là số.',
            'gia_sale.numeric' => 'Giá sale phải là số.',
            'mo_ta.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);
        $oCung->update($data);
        return redirect()->route('admin.ocung.index')->with('message', 'Ổ cứng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oCung = OCung::findOrFail($id);
        $oCung->delete();
        return redirect()->route('admin.ocung.index')->with('message', 'Ổ cứng đã được xóa thành công.');
    }
    public function trash()
    {
        $oCungs = OCung::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('admin.ocung.trash', compact('oCungs'));
    }

    public function restore($id)
    {
        $oCung = OCung::onlyTrashed()->findOrFail($id);
        $oCung->restore();
        return redirect()->route('admin.ocung.trash')->with('message', 'Đã khôi phục ổ cứng thành công.');
    }

    public function forceDelete($id)
    {
        try {
            DB::beginTransaction();
            $oCung = Ocung::withTrashed()->findOrFail($id);
            if ($oCung->bienTheSanPhams()->withTrashed()->exists()) {
                DB::rollBack();
                return redirect()->route('admin.ocung.trash')->with('error', 'Không thể xóa ổ cứng này vì nó có biến thể sản phẩm liên quan.');
            }
            $oCung->forceDelete();
            DB::commit();
            return redirect()->route('admin.ocung.trash')->with('message', 'Đã xóa vĩnh viễn ổ cứng thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.ocung.trash')->with('error', 'Đã xảy ra lỗi khi xóa ổ cứng: ' . $e->getMessage());
        }
    }
}
