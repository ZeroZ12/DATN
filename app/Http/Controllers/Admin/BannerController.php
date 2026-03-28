<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:banners,title',
            'image_url' => 'required|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho phép các định dạng hình ảnh
            'description' => 'nullable|string',
        ],
            [
                'title.required' => 'Tiêu đề là bắt buộc.',
                'title.unique' => 'Tiêu đề đã tồn tại.',
                'image_url.required' => 'Ảnh banner là bắt buộc.',
                'image_url.mimes' => 'Ảnh banner phải có định dạng jpeg, png, jpg hoặc gif.',
                'image_url.max' => 'Ảnh banner không được vượt quá 2MB.',
            ]
    );
    // Kiểm tra thêm ảnh
    
    if ($request->hasFile('image_url')) {
        $validated['image_url'] = $request->file('image_url')->store('banners', 'public');
    }

    Banner::create($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Thêm banner thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner, $id)
    {   
        $banner = Banner::withTrashed()->findOrFail($id);
      
        return view('admin.banners.show', compact('banner', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner, $id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
      
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {   
        $banner = Banner::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:banners,title',
            'image_url' => 'required|mimes:jpeg,png,jpg,gif|max:2048', // Chỉ cho phép các định dạng hình ảnh
            'description' => 'nullable|string',
        ],
            [
                'title.required' => 'Tiêu đề là bắt buộc.',
                'title.unique' => 'Tiêu đề đã tồn tại.',
                'image_url.required' => 'Ảnh banner là bắt buộc.',
                'image_url.mimes' => 'Ảnh banner phải có định dạng jpeg, png, jpg hoặc gif.',
                'image_url.max' => 'Ảnh banner không được vượt quá 2MB.',
            ]
        );
        // Kiểm tra thêm ảnh và xóa ảnh cũ nếu có
        if ($request->hasFile('image_url')) {
            // Xóa ảnh cũ nếu có
            if ($banner->image_url) {
                Storage::disk('public')->delete($banner->image_url);
            }
            
            $validated['image_url'] = $request->file('image_url')->store('banners', 'public');
        }
        $banner->update($validated);
        return redirect()->route('admin.banner.index')->with('success', 'Cập nhật banner thành công.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
      
        // Xóa ảnh nếu có
        // if ($banner->image_url) {
        //     Storage::disk('public')->delete($banner->image_url);
        // }
        // Xóa mềm banner
        $banner->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Xóa banner thành công.');
    }
    /**
     * Display the specified resource.
     */
    // Xóa mềm banner
    public function trashed()
    {
       $banners = Banner::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
       return view('admin.banners.trashed', compact('banners'));
    }

    /**
     * Restore the specified resource from soft delete.
     */
    // Phục hồi banner đã xóa mềm
    public function restore($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
      
        
        $banner->restore();
        return redirect()->route('admin.banner.trashed')->with('success', 'Khôi phục banner thành công.');
    }
    /**
     * Force delete the specified resource.
     */
    // Xóa vĩnh viễn banner
    public function forceDelete($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);
      
        $banner->forceDelete();
        return redirect()->route('admin.banner.showall')->with('success', 'Xóa vĩnh viễn banner thành công.');
    }

    public function showall()
    {
        $banners = Banner::withTrashed()
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.banners.showall', compact('banners'));
    }
}
