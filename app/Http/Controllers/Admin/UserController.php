<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Kiểm tra nếu người dùng không phải admin
        if (Auth::user()->vai_tro !== 'quan_tri') {
            return redirect()->route('admin.users.index')->with('error', 'Bạn không có quyền chỉnh sửa người dùng!');
        }

        // Không cho phép admin tự chỉnh sửa vai trò của mình
        if (Auth::id() == $user->id) {
            $request->validate([
                'ho_ten' => 'required|string|max:100',
                'so_dien_thoai' => 'required|string|max:20',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'ten_dang_nhap' => 'required|string|max:50|unique:users,ten_dang_nhap,' . $user->id . ',id',
                'trang_thai' => 'required|in:hoat_dong,vo_hieu,an',
            ]);

            // Chỉ cập nhật thông tin cá nhân, không thay đổi vai trò
            $user->update($request->only('ho_ten', 'so_dien_thoai', 'email', 'ten_dang_nhap', 'trang_thai'));

            return redirect()->route('admin.users.index')->with('success', 'Cập nhật thông tin cá nhân thành công.');
        }

        // Kiểm tra vai trò hợp lệ khi admin chỉnh sửa user khác
        $request->validate([
            'ho_ten' => 'required|string|max:100',
            'so_dien_thoai' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'vai_tro' => 'required|in:quan_tri,khach_hang',
            'ten_dang_nhap' => 'required|string|max:50|unique:users,ten_dang_nhap,' . $user->id . ',id',
            'trang_thai' => 'required|in:hoat_dong,vo_hieu,an',
        ]);

        // Thử cập nhật thông tin user
        try {
            $user->update($request->only('ho_ten', 'so_dien_thoai', 'email', 'vai_tro', 'ten_dang_nhap', 'trang_thai'));
            return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật. Vui lòng thử lại!');
        }
    }

    public function hide(User $user)
    {
        $user->trang_thai = 'an'; // Đánh dấu trạng thái "ẩn"
        $user->save();

        return back()->with('success', 'User đã được ẩn.');
    }
}
