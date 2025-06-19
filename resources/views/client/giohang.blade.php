@extends('client.layouts.app')

@section('title', 'Giỏ hàng - GEARVN')

@section('content')
<div class="container">
  <div class="cart-box">
    {{-- Bước giỏ hàng --}}
    <div class="cart-step mb-4">
      <div class="step active"><div class="circle">1</div>Giỏ hàng</div>
      <div class="step"><div class="circle">2</div>Thông tin đặt hàng</div>
      <div class="step"><div class="circle">3</div>Thanh toán</div>
      <div class="step"><div class="circle">4</div>Hoàn tất</div>
    </div>

    {{-- Hiển thị danh sách sản phẩm trong giỏ --}}
    @foreach ($gioHang->chiTietGioHangs as $item)
      <div class="cart-item d-flex mb-3">
        <img src="{{ asset('storage/' . $item->bienTheSanPham->sanPham->anh_dai_dien) }}"
     onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
     alt="Ảnh sản phẩm">

        <div class="flex-grow-1 px-3">
          <div class="cart-item-title">{{$item->bienTheSanPham->ma_bien_the ." - ". $item->bienTheSanPham->sanPham->ten ?? 'Sản phẩm' }}</div>
          <div class="cart-item-qty mt-2 d-flex align-items-center">
            <form method="POST" action="{{ route('giohang.capnhat', $item->id) }}" class="d-flex">
              @csrf
              <div class="input-group justify-content-center align-items-center" style="width: 120px;">
    <button class="btn btn-outline-secondary rounded-circle p-0 d-flex justify-content-center align-items-center"
            style="width: 32px; height: 32px;"
            type="submit" name="action" value="decrease">−</button>

    <input type="text" name="so_luong" class="form-control text-center mx-1 px-0"
           value="{{ $item->so_luong }}"
           style="width: 40px;" readonly>

    <button class="btn btn-outline-secondary rounded-circle p-0 d-flex justify-content-center align-items-center"
            style="width: 32px; height: 32px;"
            type="submit" name="action" value="increase">+</button>
</div>

            </form>
            <form method="POST" action="{{ route('giohang.xoaSanPham', $item->id) }}">
              @csrf
              @method('DELETE')
             <button class="btn btn-outline-danger btn-sm ms-3 cart-item-remove">
    <i class="fa fa-trash me-1"></i> Xoá
</button>

            </form>
          </div>
        </div>
        <div class="text-end">
          <div class="cart-item-price">{{ number_format($item->gia, 0, ',', '.') }}₫</div>
          {{-- Có thể hiển thị giá gốc nếu có --}}
          {{-- <div class="cart-item-old">...</div> --}}
        </div>
      </div>
    @endforeach

    {{-- Mã giảm giá --}}
    <div class="cart-coupon mt-3">
      <form method="POST" action="#">
        <select name="coupon_code" class="form-select w-auto d-inline-block">
          <option selected>Sử dụng mã giảm giá</option>
          <option value="SALE100K">SALE100K</option>
          <option value="FREESHIP">FREESHIP</option>
        </select>
      </form>
    </div>

    {{-- Tổng tiền --}}
    <div class="cart-total mt-3">
      Tổng tiền:
      <strong class="text-danger">
        {{ number_format($gioHang->chiTietGioHangs->sum(function($item) {
            return $item->gia * $item->so_luong;
        }), 0, ',', '.') }}₫
      </strong>
    </div>

    {{-- Nút đặt hàng --}}
    <form action="#" method="GET">
      <button class="btn btn-danger w-100 cart-checkout-btn mt-3">ĐẶT HÀNG NGAY</button>
    </form>
  </div>
</div>
@endsection
