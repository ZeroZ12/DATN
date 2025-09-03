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
      <div class="cart-item" data-item-id="{{ $item->id }}" data-stock="{{ $item->bienTheSanPham->ton_kho ?? $item->sanPham->so_luong ?? 0 }}">
        <img src="{{ asset('storage/' . ($item->bienTheSanPham->anh_dai_dien ?? $item->sanPham->anh_dai_dien)) }}" alt="{{ $item->sanPham->ten }}" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
        <div class="flex-grow-1">
          <div class="cart-item-title">{{ $item->sanPham->ten }}</div>
          @php
          // dd($item->bienTheSanPham);
            $ram = isset($item->bienTheSanPham->ram) && $item->bienTheSanPham->ram ? 'RAM: ' . $item->bienTheSanPham->ram->dung_luong : null;
            $ssd = isset($item->bienTheSanPham->oCung) && $item->bienTheSanPham->oCung ? 'SSD: ' . $item->bienTheSanPham->oCung->loai . ' ' . $item->bienTheSanPham->oCung->dung_luong : null;
          @endphp
          @if($ram || $ssd)
            <div class="text-muted small">
              @if($ram) {{ $ram }} @endif
              @if($ram && $ssd) <span class="mx-2">|</span> @endif
              @if($ssd) {{ $ssd }} @endif
            </div>
          @endif
          <div class="cart-item-qty mt-2">
            <button class="cart-qty-btn decrease" type="button">-</button>
            <input type="text" class="cart-qty-input" value="{{ $item->so_luong }}" min="1" style="width:40px; text-align:center;" readonly>
            <button class="cart-qty-btn increase" type="button">+</button>
            <span class="cart-item-remove" data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="remove-item" data-id="{{ $item->id }}">Xoá</span>
          </div>
        </div>
        <div class="text-end">
          @php
            $originalPrice = $item->bienTheSanPham->gia ?? $item->sanPham->gia;
            $displayPrice = $item->gia_hien_thi ?? $originalPrice;
          @endphp
          <div class="cart-item-price">{{ number_format($displayPrice) }}₫</div>
          @if($originalPrice > $displayPrice)
            <div class="cart-item-old">{{ number_format($originalPrice) }}₫</div>
          @endif
        </div>
      </div>
      @endforeach

      <div class="cart-coupon">
        <select class="form-select w-auto d-inline-block" id="ma-giam-gia-select">
          <option selected>Sử dụng mã giảm giá</option>
          @foreach($maGiamGias->where('so_luong', '>', 0) as $maGiamGia)
            <option value="{{ $maGiamGia->ma }}">
              {{ $maGiamGia->ma }} -
              @if($maGiamGia->loai == 'phan_tram')
                Giảm {{ $maGiamGia->gia_tri }}% - tối đa {{ number_format($maGiamGia->gia_tri_toi_da) }} VND (còn {{ number_format($maGiamGia->so_luong) }})
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
                (Giảm {{ $gioHang->maGiamGia->gia_tri }}% - tối đa {{ number_format($gioHang->maGiamGia->gia_tri_toi_da) }} VND)
              @else
                (Giảm {{ number_format($gioHang->maGiamGia->gia_tri) }}₫)
              @endif
              <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#confirmModal" data-type="remove-coupon">Xóa</button>
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
            if (isset($gioHang->maGiamGia->gia_tri_toi_da) && $discount > $gioHang->maGiamGia->gia_tri_toi_da) {
                $discount = min($discount, $gioHang->maGiamGia->gia_tri_toi_da);
            }
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

  <!-- Modal xác nhận -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Xác nhận hành động</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="confirmMessage">Bạn có chắc muốn thực hiện hành động này?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger" id="confirmActionBtn">Xác nhận</button>
        </div>
      </div>
    </div>
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

/* .cart-step::before {
  content: '';
  position: absolute;
  top: 15px;
  left: 0;
  right: 0;
  height: 2px;
  background: #e9ecef;
  z-index: 1;
} */

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

/* Tùy chỉnh modal */
#confirmModal .modal-content {
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

#confirmModal .modal-header {
  border-bottom: 1px solid #eee;
  background: #fff;
}

#confirmModal .modal-title {
  font-weight: 600;
  color: #333;
}

#confirmModal .modal-body {
  font-size: 16px;
  color: #555;
  padding: 20px;
}

#confirmModal .modal-footer {
  border-top: 1px solid #eee;
  padding: 15px;
  justify-content: flex-end;
}

#confirmModal .btn {
  border-radius: 8px;
  padding: 8px 20px;
  font-weight: 500;
}

#confirmModal .btn-secondary {
  background: #6c757d;
  color: #fff;
  border: none;
}

#confirmModal .btn-secondary:hover {
  background: #5a6268;
}

#confirmModal .btn-danger {
  background: #dc3545;
  color: #fff;
  border: none;
}

#confirmModal .btn-danger:hover {
  background: #c82333;
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
    const stock = parseInt(cartItem.dataset.stock);
    let value = parseInt(input.value);

    if (target.classList.contains('decrease')) {
      if (value > 1) {
        value--;
        updateQuantity(itemId, value, cartItem);
      } else {
        showToast('Số lượng tối thiểu là 1!', 'error');
      }
    } else if (target.classList.contains('increase')) {
      if (value < stock) {
        value++;
        updateQuantity(itemId, value, cartItem);
      } else {
        showToast(`Số lượng không được vượt quá ${stock} sản phẩm!`, 'error');
      }
    } else if (target.classList.contains('cart-item-remove')) {
      showConfirmModal('remove-item', itemId);
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

  // Xử lý modal xác nhận
  const confirmModal = document.getElementById('confirmModal');
  if (confirmModal) {
    confirmModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const type = button.getAttribute('data-type');
      const id = button.getAttribute('data-id');

      const modalBody = confirmModal.querySelector('.modal-body #confirmMessage');
      const confirmBtn = confirmModal.querySelector('#confirmActionBtn');

      if (type === 'remove-item') {
        modalBody.textContent = 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?';
        confirmBtn.onclick = () => removeItem(id, document.querySelector(`.cart-item[data-item-id="${id}"]`));
      } else if (type === 'remove-coupon') {
        modalBody.textContent = 'Bạn có chắc muốn xóa mã giảm giá này?';
        confirmBtn.onclick = removeCoupon;
      }

      confirmBtn.setAttribute('data-type', type);
      confirmBtn.setAttribute('data-id', id || '');
    });

    confirmModal.addEventListener('hide.bs.modal', function() {
      const confirmBtn = confirmModal.querySelector('#confirmActionBtn');
      confirmBtn.onclick = null;
      confirmBtn.removeAttribute('data-type');
      confirmBtn.removeAttribute('data-id');
    });
  }
});

function updateQuantity(itemId, value, cartItem) {
  const stock = parseInt(cartItem.dataset.stock);
  if (value > stock) {
    cartItem.querySelector('.cart-qty-input').value = stock;
    showToast(`Số lượng không được vượt quá ${stock} sản phẩm!`, 'error');
    value = stock;
  } else if (value < 1) {
    cartItem.querySelector('.cart-qty-input').value = 1;
    showToast('Số lượng tối thiểu là 1!', 'error');
    value = 1;
  }

  fetch(`/cart/update/${itemId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ so_luong: value })
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => {
        throw new Error(err.message || `Lỗi ${response.status}`);
      });
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      cartItem.querySelector('.cart-qty-input').value = value;
      const cartTotalElement = document.querySelector('.cart-total');
      if (data.discount > 0) {
        cartTotalElement.innerHTML = `
          Tổng tiền: ${data.originalTotal.toLocaleString()}₫<br>
          <small class="text-success">Giảm giá: -${data.discount.toLocaleString()}₫</small><br>
          <strong class="text-danger">Thành tiền: ${data.finalTotal.toLocaleString()}₫</strong>
        `;
      } else {
        cartTotalElement.textContent = `Tổng tiền: ${data.total.toLocaleString()}₫`;
      }
    } else {
      showToast(data.message || 'Có lỗi xảy ra', 'error');
      cartItem.querySelector('.cart-qty-input').value = data.currentQuantity || 1;
    }
  })
  .catch(error => {
    console.error('Error updating quantity:', error);
    showToast(error.message || 'Có lỗi xảy ra khi cập nhật số lượng', 'error');
    cartItem.querySelector('.cart-qty-input').value = 1;
  });
}

function removeItem(itemId, cartItem) {
  fetch(`/cart/remove/${itemId}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => {
    if (!response.ok) {
      return response.json().then(err => {
        throw new Error(err.message || `Lỗi ${response.status}`);
      });
    }
    return response.json();
  })
  .then(data => {
    if (data.success) {
      cartItem.remove();
      const cartTotalElement = document.querySelector('.cart-total');
      if (data.discount > 0) {
        cartTotalElement.innerHTML = `
          Tổng tiền: ${data.originalTotal.toLocaleString()}₫<br>
          <small class="text-success">Giảm giá: -${data.discount.toLocaleString()}₫</small><br>
          <strong class="text-danger">Thành tiền: ${data.finalTotal.toLocaleString()}₫</strong>
        `;
      } else {
        cartTotalElement.textContent = `Tổng tiền: ${data.total.toLocaleString()}₫`;
      }
      if (data.cartEmpty) {
        location.reload();
      }
    } else {
      showToast(data.message || 'Có lỗi xảy ra', 'error');
    }
    const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
    confirmModal.hide();
  })
  .catch(error => {
    console.error('Error removing item:', error);
    showToast(error.message || 'Có lỗi xảy ra khi xóa sản phẩm', 'error');
    const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
    confirmModal.hide();
  });
}

function removeCoupon() {
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
    const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
    confirmModal.hide();
  })
  .catch(error => {
    showToast('Có lỗi xảy ra khi xóa mã giảm giá', 'error');
    const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
    confirmModal.hide();
  });
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
</script>
@endpush
