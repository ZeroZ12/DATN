@extends('client.layouts.app');

@section('content')
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

@endsection