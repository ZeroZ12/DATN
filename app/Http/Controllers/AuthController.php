<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showForm()
    {
        return view('client.login-register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Kiểm tra vai trò user
            $user = Auth::user();
            // dd($user->role);
            if ($user->vai_tro === 'quan_tri') {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công!');
            } else {
                return redirect()->route('client.home')->with('success', 'Đăng nhập thành công!');
            }
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput($request->only('email'));
    }


    public function register(Request $request)
    {
        $request->validate([
            'ten_dang_nhap' => 'required|string|max:50',
            'ho_ten'     => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'phone'          => 'required|string|max:20|unique:users,so_dien_thoai',
            'password'       => 'required|string|min:8|confirmed',
        ], [
            'ten_dang_nhap' => 'Tên đăng nhập đã được sử dụng.',
            'email.unique'   => 'Email đã được sử dụng.',
            'phone.unique'   => 'Số điện thoại đã được sử dụng.',
        ]);

        $user = User::create([
            'ten_dang_nhap'     => $request->ten_dang_nhap,
            'ho_ten'     => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->phone,
            'password'      => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('/')->with('success', 'Đăng ký thành công! Bạn đã được đăng nhập.');
    }

    public function showLoginForm()
    {
        return view('client.tk.access');
    }
    /**
     * Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('form')->with('success', 'Đã đăng xuất!');
    }
}
