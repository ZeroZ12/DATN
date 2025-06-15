<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
// use App\Models\User; // Không cần import trực tiếp User nữa nếu chỉ dùng $request->user()
use App\Http\Requests\Client\ProfileUpdateRequest; // <<< Import Form Request mới
use Illuminate\Http\RedirectResponse; // <<< Thêm type hint cho RedirectResponse
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect; // <<< Import Redirect facade
use Illuminate\View\View; // <<< Thêm type hint cho View
use Illuminate\Support\Facades\Hash; // Nếu bạn vẫn muốn dùng Hash::make() thủ công, thì giữ lại

class ProfileController extends Controller
{
    // Giữ nguyên phương thức show()
    public function show(): View
    {
        $user = Auth::user();
        return view('client.profile.show', compact('user'));
    }

    /**
     * Xử lý yêu cầu cập nhật thông tin cá nhân.
     * Sử dụng ProfileUpdateRequest để tự động validate và lấy dữ liệu.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse // <<< Thay thế Request bằng ProfileUpdateRequest
    {
        // Lấy dữ liệu đã được xác thực từ Form Request
        $validatedData = $request->validated();

        // Gán các trường đã được xác thực vào đối tượng người dùng.
        // Phương thức fill() tự động điền các thuộc tính từ mảng vào Model.
        // Nó chỉ điền các thuộc tính có trong $fillable của User Model.
        $request->user()->fill($validatedData); // <<< Sử dụng fill()

        // Logic kiểm tra nếu email thay đổi, đặt email_verified_at về null.
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Xử lý mật khẩu riêng biệt vì có thể không phải lúc nào cũng có.
        // Nếu có mật khẩu mới, nó đã được validated và nằm trong $validatedData.
        // Do có 'password' => 'hashed' trong User Model, Laravel sẽ tự động băm.
        if (!empty($validatedData['password'])) {
            $request->user()->password = $validatedData['password'];
        } else {
            // Nếu không có mật khẩu mới, hãy đảm bảo không ghi đè mật khẩu cũ bằng null
            // Bạn không cần làm gì ở đây, vì nếu password không có trong $validatedData
            // hoặc $validatedData['password'] rỗng, nó sẽ không được fill()
            // và chúng ta đã xử lý riêng nếu nó có giá trị.
        }


        // Lưu các thay đổi vào cơ sở dữ liệu.
        // $request->user() trả về một đối tượng User Model, nên phương thức save() hoạt động bình thường.
        $request->user()->save();

        // Chuyển hướng về lại trang profile với thông báo thành công.
        // Redirect::route() là cách chuẩn để chuyển hướng đến một route đã đặt tên.
        return Redirect::route('client.profile.show')->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }


}