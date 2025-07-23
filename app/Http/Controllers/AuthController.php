<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showForm()
    {
        if (Auth::check()) {
            return redirect()->route('client.home');
        }
        return response()
            ->view('client.login-register')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('client.home');
        }
        return view('client.tk.access');
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
        // $request->validate([
        //     'ten_dang_nhap' => 'required|string|max:50|unique:users,ten_dang_nhap',
        //     'ho_ten'     => 'required|string|max:255',
        //     'email'          => 'required|email|unique:users,email',
        //     'phone'          => 'required|string|max:20|unique:users,so_dien_thoai',
        //     'password'       => 'required|string|min:8|confirmed',
        // ], [
        //     'ten_dang_nhap' => 'Tên đăng nhập đã được sử dụng.',
        //     'email.unique'   => 'Email đã được sử dụng.',
        //     'phone.unique'   => 'Số điện thoại đã được sử dụng.',
        //     'email.required' => 'Không được bỏ trống email',
        //     'ho_ten.required' => 'Không được bỏ trống họ tên',
        //     'phone.required' => 'Không được bỏ trống số điện thoại',
        //     'password.required' => 'Không được bỏ trống mật khẩu',
        //     'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        //     'password.min' => 'Mật khẩu phải trên 8 kí tự',
        // ]);

$request->validate([
    'ten_dang_nhap' => 'required|string|max:50|regex:/^[a-zA-Z0-9_]+$/|unique:users,ten_dang_nhap',
    'ho_ten' => 'required|string|max:255|regex:/^[a-zA-Z\s\-\'\p{L}]+$/u',
    'email' => 'required|email|unique:users,email',
    'phone' => 'required|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,so_dien_thoai',
    'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|confirmed',
], [
    'ten_dang_nhap.required' => 'Không được bỏ trống tên đăng nhập.',
    'ten_dang_nhap.max' => 'Tên đăng nhập không được vượt quá 50 ký tự.',
    'ten_dang_nhap.regex' => 'Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới.',
    'ten_dang_nhap.unique' => 'Tên đăng nhập đã được sử dụng.',

    'ho_ten.required' => 'Không được bỏ trống họ tên.',
    'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',
    'ho_ten.regex' => 'Họ tên chỉ được chứa chữ cái, khoảng trắng, dấu gạch ngang hoặc dấu nháy.',

    'email.required' => 'Không được bỏ trống email.',
    'email.email' => 'Email không đúng định dạng.',
    'email.unique' => 'Email đã được sử dụng.',

    'phone.required' => 'Không được bỏ trống số điện thoại.',
    'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
    'phone.regex' => 'Số điện thoại chỉ được chứa số, dấu +, -, hoặc ngoặc.',
    'phone.unique' => 'Số điện thoại đã được sử dụng.',

    'password.required' => 'Không được bỏ trống mật khẩu.',
    'password.min' => 'Mật khẩu phải trên 8 ký tự.',
    'password.regex' => 'Mật khẩu phải chứa chữ hoa, chữ thường, số và ký tự đặc biệt.',
    'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
]);

        $user = User::create([
            'ten_dang_nhap'     => $request->ten_dang_nhap,
            'ho_ten'     => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->phone,
            'password'      => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký thành công! Bạn đã được đăng nhập.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Đã đăng xuất!');
    }
}
