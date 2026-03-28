@extends('client.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-header bg-danger text-white text-center rounded-top">
                    <h4 class="mb-0 fw-bold">QUÊN MẬT KHẨU</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Hiển thị thông báo khi gửi thành công --}}
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Form nhập email --}}
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Nhập email của bạn" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger w-100 mb-3 py-2">
                            Gửi link đặt lại mật khẩu
                        </button>

                        <div class="text-center">
                            <a href="{{ route('form', ['type' => 'login']) }}" class="text-decoration-none">
                                ← Quay lại đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


