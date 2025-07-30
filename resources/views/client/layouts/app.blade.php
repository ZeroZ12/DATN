<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- @auth
  <meta name="user-authenticated" content="true">
  @endauth
  <title>{{ config('app.name', 'Laravel') }}</title> --}}
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/clients/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style_2.css') }}">
  <link rel="icon" href="{{ asset('assets/images/logo.svg') }}" sizes="64x64" type="image/svg+xml">
  {{-- <link rel="stylesheet" href="{{ asset('assets/js/script_2.css') }}"> --}}
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
  @stack('css')
  <title>@yield('title', 'Electro - Cửa hàng máy tính')</title>
</head>
<body>
  <div class="d-flex flex-column min-vh-100">
    <!-- Header Top -->
    @include('client.layouts.blocks.header')

    <!-- Danh sách sản phẩm -->
    @yield('content')

    <!-- Footer -->
    <div class="mt-auto">
      @include('client.layouts.blocks.footer')
    </div>
  </div>
  @stack('js')
</body>
</html>
