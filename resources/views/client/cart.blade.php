@extends('client.layouts.app')

@section('content')
<div class="container mt-3 mb-3">
  <a href="{{ route('client.home') }}" class="text-danger small"><i class="fa fa-angle-left"></i> Mua thêm sản phẩm khác</a>
</div>

<div class="container">
  <div class="cart-box">
    <div class="cart-step mb-4">
      <div class="step active"><div class="circle">1</div>Giỏ hàng</div>
      <div class="step"><div class="circle">2</div>Thông tin đặt hàng</div>
      <div class="step"><div class="circle">3</div>Thanh toán</div>
      <div class="step"><div class="circle">4</div>Hoàn tất</div>
    </div>

    @if($gioHang->chiTietGioHangs->count() > 0)
      @foreach($gioHang->chiTietGioHangs as $item)
      <div class="cart-item" data-item-id="{{ $item->id }}">
        <img src="{{ asset('storage/' . ($item->bienThe->anh_dai_dien ?? $item->sanPham->anh_dai_dien)) }}" alt="{{ $item->sanPham->ten }}">
        <div class="flex-grow-1">
          <div class="cart-item-title">{{ $item->sanPham->ten }}</div>
          <div class="cart-item-qty mt-2">
            <button class="cart-qty-btn decrease" type="button">-</button>
            <input type="text" class="cart-qty-input" value="{{ $item->so_luong }}" min="1" style="width:40px; text-align:center;" readonly>
            <button class="cart-qty-btn increase" type="button">+</button>
            <span class="cart-item-remove">Xoá</span>
          </div>
        </div>
        <div class="text-end">
          <div class="cart-item-price">{{ number_format($item->bienThe->gia ?? $item->sanPham->gia) }}₫</div>
          @if(($item->bienThe->gia_so_sanh ?? $item->sanPham->gia_so_sanh) > ($item->bienThe->gia ?? $item->sanPham->gia))
            <div class="cart-item-old">{{ number_format($item->bienThe->gia_so_sanh ?? $item->sanPham->gia_so_sanh) }}₫</div>
          @endif
        </div>
      </div>
      @endforeach

      <div class="cart-coupon">
        <select class="form-select w-auto d-inline-block" id="ma-giam-gia-select">
          <option selected>Sử dụng mã giảm giá</option>
          @foreach($maGiamGias as $maGiamGia)
            <option value="{{ $maGiamGia->ma }}">
              {{ $maGiamGia->ma }} -
              @if($maGiamGia->loai == 'phan_tram')
                Giảm {{ $maGiamGia->gia_tri }}%
              @else
                Giảm {{ number_format($maGiamGia->gia_tri) }}₫
              @endif
              @if($maGiamGia->dieu_kien > 0)
                (ĐH tối thiểu {{ number_format($maGiamGia->dieu_kien) }}₫)
              @endif
            </option>
          @endforeach
        </select>
        @if($gioHang->maGiamGia)
          <div class="mt-2">
            <small class="text-success">
              <i class="fas fa-check-circle"></i>
              Đã áp dụng mã: {{ $gioHang->maGiamGia->ma }}
              @if($gioHang->maGiamGia->loai == 'phan_tram')
                (Giảm {{ $gioHang->maGiamGia->gia_tri }}%)
              @else
                (Giảm {{ number_format($gioHang->maGiamGia->gia_tri) }}₫)
              @endif
              <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeCoupon()">
                <i class="fas fa-times"></i> Xóa
              </button>
            </small>
          </div>
        @endif
      </div>

      <div class="cart-total">
        Tổng tiền: {{ number_format($total) }}₫
        @if($gioHang->maGiamGia)
          @php
            $discount = $gioHang->maGiamGia->loai == 'phan_tram'
              ? ($total * $gioHang->maGiamGia->gia_tri / 100)
              : $gioHang->maGiamGia->gia_tri;
            $finalTotal = max(0, $total - $discount);
          @endphp
          <br>
          <small class="text-success">
            Giảm giá: -{{ number_format($discount) }}₫
          </small>
          <br>
          <strong class="text-danger">
            Thành tiền: {{ number_format($finalTotal) }}₫
          </strong>
        @endif
      </div>
      <button class="btn btn-danger w-100 cart-checkout-btn" onclick="window.location.href='{{ route('client.cart.checkout') }}'">ĐẶT HÀNG NGAY</button>
    @else
      <div class="text-center py-5">
        <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
        <h4>Giỏ hàng của bạn đang trống</h4>
        <p class="text-muted">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
        <a href="{{ route('client.home') }}" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
      </div>
    @endif
  </div>
</div>
@endsection

@push('css')
<style>
.cart-box {
  background: white;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.cart-step {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin-bottom: 30px;
}

.cart-step::before {
  content: '';
  position: absolute;
  top: 15px;
  left: 0;
  right: 0;
  height: 2px;
  background: #e9ecef;
  z-index: 1;
}

.step {
  position: relative;
  z-index: 2;
  background: white;
  padding: 0 15px;
  text-align: center;
  color: #6c757d;
  font-size: 14px;
}

.step .circle {
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 50%;
  background: #e9ecef;
  color: #6c757d;
  margin: 0 auto 8px;
  font-weight: bold;
}

.step.active {
  color: #dc3545;
}

.step.active .circle {
  background: #dc3545;
  color: white;
}

.cart-item {
  display: flex;
  align-items: center;
  padding: 15px 0;
  border-bottom: 1px solid #e9ecef;
}

.cart-item img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  margin-right: 15px;
}

.cart-item-title {
  font-size: 16px;
  font-weight: 500;
  color: #333;
  margin-bottom: 5px;
}

.cart-item-qty {
  display: flex;
  align-items: center;
  gap: 10px;
}

.cart-qty-btn {
  width: 30px;
  height: 30px;
  border: 1px solid #dee2e6;
  background: white;
  border-radius: 4px;
  cursor: pointer;
}

.cart-qty-btn:hover {
  background: #f8f9fa;
}

.cart-qty-input {
  border: 1px solid #dee2e6;
  border-radius: 4px;
  padding: 5px;
}

.cart-item-remove {
  color: #dc3545;
  cursor: pointer;
  margin-left: 15px;
}

.cart-item-price {
  font-size: 18px;
  font-weight: bold;
  color: #dc3545;
}

.cart-item-old {
  color: #999;
  text-decoration: line-through;
  font-size: 14px;
}

.cart-coupon {
  margin: 20px 0;
  padding: 15px 0;
  border-bottom: 1px solid #e9ecef;
}

.cart-total {
  font-size: 20px;
  font-weight: bold;
  color: #333;
  margin: 20px 0;
}

.cart-checkout-btn {
  padding: 15px;
  font-size: 18px;
  font-weight: 500;
}

@media (max-width: 575px) {
  .cart-box { padding: 10px; }
  .cart-item-title { font-size: 14px; }
  .cart-step .step .circle { width: 26px; height: 26px; line-height: 26px; font-size: 15px; }
  .cart-item img { width: 48px; height: 48px; }
  .cart-total { font-size: 18px; }
  .cart-checkout-btn { font-size: 16px; padding: 10px 0; }
}
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const cartBox = document.querySelector('.cart-box');
  if (!cartBox) return;

  // Xử lý tăng/giảm số lượng
  cartBox.addEventListener('click', function(e) {
    const target = e.target;
    const cartItem = target.closest('.cart-item');
    if (!cartItem) return;

    const itemId = cartItem.dataset.itemId;
    const input = cartItem.querySelector('.cart-qty-input');
    let value = parseInt(input.value);

    if (target.classList.contains('decrease')) {
      if (value > 1) {
        value--;
        updateQuantity(itemId, value);
      }
    } else if (target.classList.contains('increase')) {
      value++;
      updateQuantity(itemId, value);
    } else if (target.classList.contains('cart-item-remove')) {
      removeItem(itemId, cartItem);
    }
  });

  // Xử lý mã giảm giá
  const maGiamGiaSelect = document.getElementById('ma-giam-gia-select');
  if (maGiamGiaSelect) {
    maGiamGiaSelect.addEventListener('change', function() {
      const maGiamGia = this.value;
      if (maGiamGia === 'Sử dụng mã giảm giá') return;

      fetch('/cart/apply-coupon', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ma_giam_gia: maGiamGia })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const cartTotalElement = document.querySelector('.cart-total');
          if (data.discount > 0) {
            cartTotalElement.innerHTML = `
              Tổng tiền: ${data.originalTotal.toLocaleString()}₫<br>
              <small class="text-success">Giảm giá: -${data.discount.toLocaleString()}₫</small><br>
              <strong class="text-danger">Thành tiền: ${data.finalTotal.toLocaleString()}₫</strong>
            `;
          } else {
            cartTotalElement.textContent = `Tổng tiền: ${data.finalTotal.toLocaleString()}₫`;
          }
          showToast('Áp dụng mã giảm giá thành công!', 'success');
          // Reload trang để cập nhật hiển thị mã giảm giá đã áp dụng
          setTimeout(() => location.reload(), 1000);
        } else {
          showToast(data.message || 'Có lỗi xảy ra', 'error');
          this.value = 'Sử dụng mã giảm giá';
        }
      })
      .catch(error => {
        showToast('Có lỗi xảy ra khi áp dụng mã giảm giá', 'error');
        this.value = 'Sử dụng mã giảm giá';
      });
    });
  }
});

function updateQuantity(itemId, value) {
  fetch(`/cart/update/${itemId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ so_luong: value })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const cartItem = document.querySelector(`.cart-item[data-item-id="${itemId}"]`);
      if (cartItem) {
        cartItem.querySelector('.cart-qty-input').value = value;
      }
      document.querySelector('.cart-total').textContent = `Tổng tiền: ${data.total.toLocaleString()}₫`;
    } else {
      showToast(data.message || 'Có lỗi xảy ra', 'error');
    }
  })
  .catch(error => {
    showToast('Có lỗi xảy ra khi cập nhật số lượng', 'error');
  });
}

function removeItem(itemId, cartItem) {
  if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
    fetch(`/cart/remove/${itemId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        cartItem.remove();
        document.querySelector('.cart-total').textContent = `Tổng tiền: ${data.total.toLocaleString()}₫`;
        if (data.cartEmpty) {
          location.reload();
        }
      } else {
        showToast(data.message || 'Có lỗi xảy ra', 'error');
      }
    })
    .catch(error => {
      showToast('Có lỗi xảy ra khi xóa sản phẩm', 'error');
    });
  }
}

function showToast(message, type = 'success') {
  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  toast.innerHTML = `
    <div class="toast-content">
      <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
      <span>${message}</span>
    </div>
  `;

  if (!document.querySelector('#toast-styles')) {
    const style = document.createElement('style');
    style.id = 'toast-styles';
    style.textContent = `
      .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        border-left: 4px solid #28a745;
      }
      .toast.toast-error {
        border-left-color: #dc3545;
      }
      .toast-content {
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
        font-size: 14px;
      }
      .toast.show {
        transform: translateX(0);
      }
    `;
    document.head.appendChild(style);
  }

  document.body.appendChild(toast);
  setTimeout(() => toast.classList.add('show'), 100);
  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

function removeCoupon() {
  if (confirm('Bạn có chắc muốn xóa mã giảm giá này?')) {
    fetch('/cart/remove-coupon', {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showToast('Đã xóa mã giảm giá', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Có lỗi xảy ra', 'error');
      }
    })
    .catch(error => {
      showToast('Có lỗi xảy ra khi xóa mã giảm giá', 'error');
    });
  }
}
</script>
@endpush
