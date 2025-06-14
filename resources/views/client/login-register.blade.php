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
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mb-4 py-2">ĐĂNG NHẬP</button>
                    </form>

                    <form id="registerForm" method="POST" action="{{ route('register') }}" style="display:none;">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="last_name" class="form-control form-control-lg" placeholder="Họ">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="first_name" class="form-control form-control-lg" placeholder="Tên">
                        </div>
                        <div class="mb-4">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mb-4 py-2">TẠO TÀI KHOẢN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const formType = urlParams.get('type');

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

    // Initialize form based on URL parameter
    if (formType === 'register') {
      switchForm(true);
    } else {
      switchForm(false);
    }

    // Handle form switch
    formSwitch.addEventListener('change', function() {
      switchForm(this.checked);
    });
</script>
@endsection