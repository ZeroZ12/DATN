@extends('client.layouts.app')
@section('content')
@include('client.layouts.blocks.banner')
  <div class="container py-4">
    <!-- Categories Section -->
    @foreach($danhMucs as $danhMuc)
    <div class="product-section mb-4">
      <div class="section-header">
        <h2 class="section-title">{{ $danhMuc->ten }}</h2>
        <form method="GET" action="{{ route('client.home') }}" class="filter-form">
          {{-- <div class="filter-tabs">
            <button type="button"
                    class="filter-tab {{ !request()->hasAny(['id_brand', 'id_chip', 'id_gpu', 'id_ram', 'id_o_cung']) ? 'active' : '' }}">
              Tình trạng sản phẩm
            </button>
            <button type="button" class="filter-tab">Giá</button>

            <select name="id_brand" class="filter-tab-select">
              <option value="">Hãng</option>
              @foreach($thuongHieus as $item)
                <option value="{{ $item->id }}" {{ request('id_brand') == $item->id ? 'selected' : '' }}>
                  {{ $item->ten }}
                </option>
              @endforeach
            </select>

      <select name="id_chip" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- CPU --</option>
      @foreach($chips as $item)
      <option value="{{ $item->id }}" {{ request('id_chip') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
    @endforeach
      </select>

      <select name="id_gpu" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- GPU --</option>
      @foreach($gpus as $item)
      <option value="{{ $item->id }}" {{ request('id_gpu') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
    @endforeach
      </select>

      <select name="id_ram" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- RAM --</option>
      @foreach($rams as $item)
      <option value="{{ $item->id }}" {{ request('id_ram') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}
      </option>
    @endforeach
      </select>

      <select name="id_o_cung" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- Ổ cứng --</option>
      @foreach($oCungs as $item)
      <option value="{{ $item->id }}" {{ request('id_o_cung') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}
      </option>
    @endforeach
      </select>

      <button type="submit" class="btn btn-sm btn-primary">Lọc</button>
      <a href="{{ route('client.home') }}" class="btn btn-sm btn-outline-secondary">Đặt lại</a>
    </div>
    </form>
  </div>


      <!-- Danh sách sản phẩm -->
      <div class="products-slider-wrapper">
        <button type="button" class="slider-btn left" onclick="scrollProducts(this, -1)"><i class="fas fa-chevron-left"></i></button>
        <div class="products-slider">
          @foreach ($sanphams->where('id_category', $danhMuc->id) as $sp)
            @php
              $bienThe = $sp->BienTheSanPhams->firstWhere(function ($bt) {
                return
                  (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                  (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
              }) ?? $sp->BienTheSanPhams->first();
            @endphp

            <div class="product-card">
              <div class="product-badges">
                @if ($sp->is_hot)
                  <span class="product-badge hot-badge">
                    <i class="fas fa-gift"></i> Quà tặng HOT
                  </span>
                @elseif(rand(1,3) == 1)
                  <span class="product-badge bestseller-badge">
                    <i class="fas fa-fire"></i> Bán chạy
                  </span>
                @elseif(rand(1,2) == 1)
                  <span class="product-badge gift-badge">
                    <i class="fas fa-gift"></i> Quà tặng
                  </span>
                @endif
              </div>
              <div class="product-image">
                <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
                     alt="{{ $sp->ten }}">
              </div>
              <div class="product-info">
                <h3 class="product-title">{{ $sp->ten }}</h3>
                <div class="product-price">
                  @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                    <div class="old-price">{{ number_format($bienThe->gia_so_sanh) }}₫</div>
                  @endif
                  <div class="current-price">{{ number_format($bienThe->gia ?? 0) }}₫</div>
                </div>
                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                  <div class="discount-badge">
                    -{{ round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh) }}%
                  </div>
                @endif
                <div class="product-rating">
                  <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="fas fa-star"></i>
                    @endfor
                  </div>
                  <span class="rating-text">({{ rand(3, 15) }})</span>
                </div>
                <div class="product-actions">
                    <form action="{{ route('client.cart.add') }}" method="POST" class="add-to-cart-form" onsubmit="return addToCart(event, {{ $sp->id }}, {{ $bienThe->id ?? 'null' }})">
                    @csrf
                    <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                    <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}">
                    <input type="hidden" name="so_luong" value="1">
                    <button type="submit" class="add-to-cart-btn">
                      <i class="fas fa-shopping-cart"></i>
                      <span>Thêm vào giỏ</span>
                    </button>
                  </form>
                  <a href="{{ route('sanpham.show', $sp->id) }}" class="product-detail-btn">
                    <i class="fas fa-info-circle"></i>
                    <span>Chi tiết</span>
                  </a>
                </div>
              </div>
              <a href="{{ route('sanpham.show', $sp->id) }}" class="product-link"></a>
            </div>
          @endforeach
        </div>
        <button type="button" class="slider-btn right" onclick="scrollProducts(this, 1)"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
    @endforeach

    <!-- Phân trang -->
    <div class="pagination-wrapper">
      {{ $sanphams->links() }}
    </div>
  </div>

@push('css')
<style>
  .product-section {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .section-header {
    margin-bottom: 20px;
  }

  .section-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
  }

  .filter-form {
    margin-bottom: 20px;
  }

  .filter-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 0;
    border-bottom: 1px solid #e9ecef;
    align-items: center;
  }

  .filter-tab {
    background: transparent;
    border: none;
    color: #6c757d;
    padding: 12px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    border-bottom: 3px solid transparent;
    white-space: nowrap;
  }

  .filter-tab.active {
    background: #007bff;
    color: white;
    border-radius: 6px 6px 0 0;
    border-bottom-color: #007bff;
  }

  .filter-tab:hover:not(.active) {
    background: #f8f9fa;
    color: #495057;
  }

  .filter-tab-select {
    background: transparent;
    border: none;
    color: #6c757d;
    padding: 12px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    border-bottom: 3px solid transparent;
    outline: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 8px center;
    background-repeat: no-repeat;
    background-size: 16px 16px;
    padding-right: 32px;
  }

  .filter-tab-select:hover {
    background-color: #f8f9fa;
    color: #495057;
  }

  .filter-tab-select:focus {
    background-color: #e9ecef;
    outline: none;
  }

  .filter-submit-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    border-radius: 6px;
    margin-left: 10px;
    white-space: nowrap;
    font-weight: 500;
  }

  .filter-submit-btn:hover {
    background: #0056b3;
    transform: translateY(-1px);
  }

  .filter-reset-btn {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    border-radius: 6px;
    margin-left: 5px;
    white-space: nowrap;
    font-weight: 500;
  }

  .filter-reset-btn:hover {
    background: #5a6268;
    transform: translateY(-1px);
  }

  .products-slider-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 30px;
  }
  .products-slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 10px;
    width: 100%;
  }
  .product-card {
    min-width: 270px;
    max-width: 270px;
    flex: 0 0 270px;
    position: relative;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
  }
  .product-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
  }
  .slider-btn {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
    font-size: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: background 0.2s;
  }
  .slider-btn.left { margin-right: 10px; }
  .slider-btn.right { margin-left: 10px; }
  .slider-btn:hover { background: #f0f0f0; }
  @media (max-width: 1200px) {
    .product-card { min-width: 220px; max-width: 220px; flex: 0 0 220px; }
  }
  @media (max-width: 768px) {
    .product-card { min-width: 180px; max-width: 180px; flex: 0 0 180px; }
  }

  .product-badges {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 2;
  }

  .product-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: bold;
    color: white;
    margin-bottom: 5px;
  }

  .hot-badge {
    background: linear-gradient(45deg, #ff6b35, #f7931e);
  }

  .bestseller-badge {
    background: #dc3545;
  }

  .gift-badge {
    background: #28a745;
  }

  .product-image {
    width: 100%;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    overflow: hidden;
  }

  .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .product-card:hover .product-image img {
    transform: scale(1.05);
  }

  .product-info {
    padding: 15px;
  }

  .product-actions {
    display: flex;
    gap: 8px;
    margin-top: 15px;
  }

  .add-to-cart-form {
    flex: 1;
  }

  .add-to-cart-btn {
    width: 100%;
    background: #28a745;
    color: white;
    border: none;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    position: relative;
    z-index: 2;
    min-height: 38px;
  }

  .add-to-cart-btn:hover:not(:disabled) {
    background: #218838;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
  }

  .add-to-cart-btn:active {
    transform: scale(0.98);
  }

  .add-to-cart-btn:disabled {
    cursor: not-allowed;
    pointer-events: none;
    opacity: 0.8;
  }

  .add-to-cart-btn.loading {
    background: #6c757d !important;
  }

  .add-to-cart-btn.success {
    background: #28a745 !important;
  }

  .add-to-cart-btn.error {
    background: #dc3545 !important;
  }

  .product-detail-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    position: relative;
    z-index: 2;
    min-width: 90px;
    text-decoration: none;
  }

  .product-detail-btn:hover {
    background: #0056b3;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    color: white;
    text-decoration: none;
  }

  .product-detail-btn:active {
    transform: scale(0.98);
  }

  .product-title {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 12px;
    line-height: 1.4;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    }

  .product-price {
    margin-bottom: 10px;
  }

  .old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 12px;
    margin-bottom: 2px;
  }

  .current-price {
    color: #dc3545;
    font-weight: bold;
    font-size: 16px;
  }

  .discount-badge {
    display: inline-block;
    background: #dc3545;
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .stars {
    color: #ffc107;
    font-size: 12px;
  }

  .rating-text {
    color: #666;
    font-size: 12px;
  }

  .product-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: calc(100% - 60px);
    z-index: 1;
  }

  .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .cart-count {
    transition: all 0.3s ease;
  }

  /* Animation keyframes */
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }

  @keyframes bounce {
    0%, 20%, 60%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    80% { transform: translateY(-5px); }
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
  }

  @keyframes slideInRight {
    from {
      transform: translateX(100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .fa-spinner {
    animation: spin 1s linear infinite;
  }

  @keyframes progress {
    from { width: 100%; }
    to { width: 0%; }
  }

  /* Toast notification styles */
  .toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    pointer-events: none;
  }

  .toast {
    background: white;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateX(100%);
    transition: all 0.3s ease;
    pointer-events: auto;
    min-width: 300px;
    overflow: hidden;
  }

  .toast.success {
    border-left: 4px solid #28a745;
  }

  .toast.error {
    border-left: 4px solid #dc3545;
  }

  .toast.info {
    border-left: 4px solid #17a2b8;
  }

  .toast.show {
    transform: translateX(0);
    animation: slideInRight 0.3s ease-out;
  }

  .toast-content {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #333;
    font-size: 14px;
    position: relative;
  }

  .toast-close {
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    font-size: 12px;
    margin-left: auto;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
  }

  .toast-close:hover {
    background: #f0f0f0;
    color: #666;
  }

  .toast::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: currentColor;
    opacity: 0.3;
    animation: progress 4s linear;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .filter-tabs {
      justify-content: flex-start;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .filter-tabs::-webkit-scrollbar {
      display: none;
    }

    .filter-tab,
    .filter-tab-select,
    .filter-submit-btn,
    .filter-reset-btn {
      flex-shrink: 0;
      min-width: auto;
    }

    .products-slider-wrapper {
      padding: 15px;
    }

    .toast-container {
      right: 10px;
      left: 10px;
      top: 10px;
    }

    .toast {
      min-width: auto;
      margin-bottom: 8px;
    }

    .toast-content {
      padding: 12px 15px;
      font-size: 13px;
    }
  }

  @media (max-width: 576px) {
    .products-slider-wrapper {
      padding: 10px;
    }

    .filter-tab,
    .filter-tab-select,
    .filter-submit-btn,
    .filter-reset-btn {
      padding: 10px 15px;
      font-size: 13px;
    }
  }
</style>
@endpush

@push('js')
<script>
  function addToCart(event, sanPhamId, bienTheId) {
    event.preventDefault();
    event.stopPropagation();

    const form = event.target;
    const button = form.querySelector('.add-to-cart-btn');
    const originalContent = button.innerHTML;

    // Kiểm tra CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token not found');
        showToast('Lỗi: Không tìm thấy CSRF token!', 'error');
        return;
    }

    // Reset any previous states
    button.className = 'add-to-cart-btn loading';
    button.disabled = true;
    button.style.animation = '';
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Đang thêm...</span>';

    // Create FormData from the form
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Success state
            button.className = 'add-to-cart-btn success';
            button.innerHTML = '<i class="fas fa-check"></i> <span>Đã thêm!</span>';
            button.style.animation = 'pulse 0.6s ease-in-out';

            // Update cart count
            const cartCount = document.querySelector('.cart-count');
            if (cartCount && data.cart_count) {
                cartCount.textContent = data.cart_count;
                cartCount.style.animation = 'bounce 0.6s ease-in-out';
                setTimeout(() => cartCount.style.animation = '', 600);
            }

            // Show success toast
            showToast('Đã thêm sản phẩm vào giỏ hàng!', 'success');

            // Reset button after delay
            setTimeout(() => {
                button.className = 'add-to-cart-btn';
                button.disabled = false;
                button.innerHTML = originalContent;
                button.style.animation = '';
            }, 2000);

        } else {
            // Handle redirect (login required)
            if (data.redirect) {
                showToast('Đang chuyển đến trang đăng nhập...', 'info');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
                return;
            }
            throw new Error(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);

        // Error state
        button.className = 'add-to-cart-btn error';
        button.innerHTML = '<i class="fas fa-times"></i> <span>Lỗi!</span>';
        button.style.animation = 'shake 0.6s ease-in-out';

        // Show error toast
        showToast(error.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng!', 'error');

        // Reset button after delay
        setTimeout(() => {
            button.className = 'add-to-cart-btn';
            button.disabled = false;
            button.innerHTML = originalContent;
            button.style.animation = '';
        }, 2000);
    });
  }

  function showToast(message, type = 'success') {
    // Create toast container if it doesn't exist
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    // Icon based on type
    let icon = 'check-circle';
    if (type === 'error') icon = 'exclamation-circle';
    if (type === 'info') icon = 'info-circle';

    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${icon}"></i>
            <span>${message}</span>
            <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    // Add to container
    container.appendChild(toast);

    // Show toast with animation
    setTimeout(() => toast.classList.add('show'), 100);

    // Remove toast after 4 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, 4000);
  }

  function scrollProducts(btn, direction) {
    const wrapper = btn.closest('.products-slider-wrapper');
    const slider = wrapper.querySelector('.products-slider');
    const card = slider.querySelector('.product-card');
    if (!card) return;

    const scrollAmount = card.offsetWidth + 20; // 20 là gap
    slider.scrollBy({
        left: direction * scrollAmount * 2,
        behavior: 'smooth'
    });
  }

  function resetFilters() {
    // Reset all select elements to their default values
    const selects = document.querySelectorAll('.filter-tab-select');
    selects.forEach(select => {
        select.selectedIndex = 0;
    });

    // Submit the form to clear filters
    document.querySelector('.filter-form').submit();
  }

  function showFilterModal() {
    // Implement filter modal functionality if needed
    alert('Bộ lọc nâng cao - Có thể implement modal ở đây');
  }
</script>
@endpush