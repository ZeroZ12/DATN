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
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
  @stack('css')
</head>
<body>
  <!-- Header Top -->
@include('client.layouts.blocks.header')



  <!-- Danh sách sản phẩm -->
@yield('content')
  <!-- Footer -->
@include('client.layouts.blocks.footer')

@stack('js')
</body>
</html>