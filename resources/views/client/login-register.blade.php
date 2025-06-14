@extends('client.layouts.app')


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-header bg-danger text-white text-center rounded-top">
                    <h4 class="mb-0 fw-bold" id="formTitle">ĐĂNG NHẬP</h4>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4 text-center">
                        <label class="form-check-label me-2" for="formSwitch">Bạn chưa có tài khoản?</label>
                        <input type="checkbox" id="formSwitch" style="transform: scale(1.3); vertical-align: middle;">
                        <span class="ms-1">Đăng ký</span>
                    </div>

                    {{-- Hiển thị lỗi chung cho cả hai form nếu có --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Mật khẩu">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mb-4 py-2">ĐĂNG NHẬP</button>
                    </form>

                    <form id="registerForm" method="POST" action="{{ route('register') }}" style="display:none;">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-control-lg @error('email_register') is-invalid @enderror" placeholder="Email" value="{{ old('email_register') }}"> {{-- Đổi name email để phân biệt với login --}}
                            @error('email_register')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" name="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" placeholder="Họ" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" placeholder="Tên" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="Số điện thoại" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control form-control-lg @error('password_register') is-invalid @enderror" placeholder="Mật khẩu"> {{-- Đổi name password để phân biệt với login --}}
                            @error('password_register')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Xác nhận mật khẩu">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mb-4 py-2">TẠO TÀI KHOẢN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get form elements
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const formSwitch = document.getElementById('formSwitch');
    const formTitle = document.getElementById('formTitle');

    // Function to switch between forms
    function switchForm(isRegister) {
        if (isRegister) {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            formTitle.textContent = 'ĐĂNG KÝ TÀI KHOẢN';
            formSwitch.checked = true;
        } else {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
            formTitle.textContent = 'ĐĂNG NHẬP';
            formSwitch.checked = false;
        }
    }

    // --- LOGIC MỚI: XÁC ĐỊNH FORM NÀO NÊN HIỂN THỊ KHI TẢI TRANG HOẶC CÓ LỖI ---
    let shouldShowRegisterForm = false;

    // Kiểm tra nếu có bất kỳ lỗi nào từ form Đăng ký (ưu tiên)
    // Các lỗi này thường là: first_name, last_name, phone, password_confirmation
    // hoặc lỗi 'password' khi không khớp 'password_confirmation'
    @if ($errors->has('first_name') || $errors->has('last_name') || $errors->has('phone') || $errors->has('password_register') || $errors->has('password_confirmation') || old('form_type') === 'register')
        shouldShowRegisterForm = true;
    @endif

    // Khởi tạo form dựa trên logic trên
    // Cũng kiểm tra tham số URL 'type' nếu không có lỗi nào ở trên
    const urlParams = new URLSearchParams(window.location.search);
    const formTypeFromUrl = urlParams.get('type');

    if (shouldShowRegisterForm) {
        switchForm(true);
    } else if (formTypeFromUrl === 'register') {
        switchForm(true);
    } else {
        switchForm(false);
    }


    // Xử lý chuyển đổi form bằng switch (giữ nguyên)
    formSwitch.addEventListener('change', function() {
        switchForm(this.checked);
    });

    // Thêm một trường ẩn để lưu trạng thái form khi submit (để old() có thể hoạt động)
    // Cần thay đổi tên trường email/password trong form đăng ký để tránh xung đột
    loginForm.addEventListener('submit', function() {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'form_type';
        hiddenInput.value = 'login';
        loginForm.appendChild(hiddenInput);
    });

    registerForm.addEventListener('submit', function() {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'form_type';
        hiddenInput.value = 'register';
        registerForm.appendChild(hiddenInput);
    });

</script>
@endsection