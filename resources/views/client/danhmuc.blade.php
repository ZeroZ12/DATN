@extends('client.layouts.app')

@section('content')
@include('client.layouts.blocks.banner')

<!-- Container chính để align với banner -->
<div class="container px-3 px-md-4">
  <div class="py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category->ten ?? 'Danh mục' }}</li>
      </ol>
    </nav>

    <div class="row g-3 position-relative">
      <!-- Sidebar bộ lọc -->
      <div class="col-xl-2 col-lg-3 col-md-4 mb-4">
        <div class="filter-sidebar bg-white p-3 rounded shadow-sm">
          <h6 class="fw-bold mb-3">Danh mục sản phẩm</h6>

          <!-- Danh mục con -->
          <div class="mb-4">
            <ul class="list-unstyled category-list">
              @foreach($danhmucs ?? [] as $dm)
              @if(is_object($dm))
              <li>
                <a href="{{ route('danhmuc.index', $dm->id) }}"
                   class="text-decoration-none text-dark py-1 d-block small {{ request()->route('category') == $dm->id ? 'active' : '' }}">
                  {{ $dm->ten }}
                </a>
              </li>
              @endif
              @endforeach
            </ul>
          </div>
          <!-- Bộ lọc thương hiệu -->
          <h6 class="fw-bold mb-3">Thương hiệu</h6>
          <div class="mb-4">
            @foreach($thuongHieus ?? [] as $brand)
            @if(is_object($brand))
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox"
                     id="brand_{{ $brand->id }}" name="brand[]" value="{{ $brand->id }}"
                     {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
              <label class="form-check-label small" for="brand_{{ $brand->id }}">{{ $brand->ten }}</label>
            </div>
            @endif
            @endforeach
          </div>
          <!-- Lọc giá -->
          <h6 class="fw-bold mb-3">Lọc giá</h6>
          <div class="mb-4">
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox" id="price1" name="price[]" value="0-5000000">
              <label class="form-check-label small" for="price1">< 5tr</label>
            </div>
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox" id="price2" name="price[]" value="5000000-10000000">
              <label class="form-check-label small" for="price2">5tr - 10tr</label>
            </div>
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox" id="price3" name="price[]" value="10000000-15000000">
              <label class="form-check-label small" for="price3">10tr - 15tr</label>
            </div>
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox" id="price4" name="price[]" value="15000000-20000000">
              <label class="form-check-label small" for="price4">15tr - 20tr</label>
            </div>
            <div class="form-check mb-1">
              <input class="form-check-input form-check-input-sm" type="checkbox" id="price5" name="price[]" value="20000000-999999999">
              <label class="form-check-label small" for="price5">> 20tr</label>
            </div>
          </div>

          <!-- Nút áp dụng bộ lọc -->
          <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">
              <i class="fas fa-filter"></i> Áp dụng lọc
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetFilters()">
              <i class="fas fa-times"></i> Xóa bộ lọc
            </button>
          </div>
        </div>
      </div>

      <!-- Nội dung chính -->
      <div class="col-xl-10 col-lg-9 col-md-8">
        <!-- Header danh sách sản phẩm -->
        <div class="product-section bg-white rounded shadow-sm p-3 mb-3">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
            <h5 class="fw-bold mb-0">{{ $category->ten ?? 'PC - Máy tính chơi game, Làm việc' }}</h5>
            <div class="d-flex align-items-center gap-3">
              <span class="text-muted small">{{ $sanphams->total() }} sản phẩm</span>

              <!-- Sort dropdown -->
              <select class="form-select form-select-sm" style="width: 140px;" onchange="sortProducts(this.value)">
                <option value="">Sắp xếp</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến</option>
              </select>
            </div>
          </div>
          <!-- Mobile filter button -->
          <div class="d-md-none mb-3">
            <button class="btn btn-outline-primary btn-sm w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilters">
              <i class="fas fa-filter"></i> Bộ lọc
            </button>
          </div>
        </div>
        <!-- Danh sách sản phẩm -->
        <div class="products-section">
          <div class="products-grid">
            @forelse ($sanphams as $sp)
            @php
              // Lấy biến thể phù hợp với filter
              $bienThe = $sp->BienTheSanPhams->firstWhere(function ($bt) {
                return
                  (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                  (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
              }) ?? $sp->BienTheSanPhams->first();

              // Tính phần trăm giảm giá
              $discountPercent = 0;
              if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia) {
                $discountPercent = round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh);
              }
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
                  <div class="current-price-wrapper">
                    <div class="current-price">{{ number_format($bienThe->gia ?? 0) }}₫</div>
                    @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                      <div class="discount-badge">
                        -{{ $discountPercent }}%
                      </div>
                    @endif
                  </div>
                </div>

                <div class="product-rating">
                    @php
                        $avgRating = $sp->danh_gia_san_phams_avg_so_sao ?? 0;
                        $reviewCount = $sp->danh_gia_san_phams_count ?? 0;
                    @endphp
                    <span class="rating-score">{{ number_format($avgRating, 1) }}</span>
                    <i class="fas fa-star text-warning"></i>
                    <span class="rating-text">({{ $reviewCount }} đánh giá)</span>
                </div>

                <div class="product-actions">
                  <form action="" method="POST" class="add-to-cart-form" onsubmit="addToCart(event, {{ $sp->id }}, {{ $bienThe->id ?? 'null' }})">
                    @csrf
                    <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                    <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}">
                    <input type="hidden" name="so_luong" value="1">

                    <button type="submit" class="add-to-cart-btn">
                      <i class="fas fa-shopping-cart"></i>
                      <span>Thêm vào giỏ</span>
                    </button>
                  </form>
                </div>
              </div>

              <a href="{{ route('client.sanphams.show', $sp->id) }}" class="product-link"></a>
            </div>
            @empty
            <div class="col-12">
              <div class="text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Không tìm thấy sản phẩm nào</h5>
                <p class="text-muted">Hãy thử điều chỉnh bộ lọc hoặc tìm kiếm với từ khóa khác</p>
                <button class="btn btn-primary" onclick="resetFilters()">Xóa bộ lọc</button>
              </div>
            </div>
            @endforelse
          </div>

          <!-- Phân trang -->
          @if($sanphams->hasPages())
          <div class="pagination-wrapper mt-4">
            {{ $sanphams->appends(request()->query())->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Mobile Filter Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilters" aria-labelledby="mobileFiltersLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileFiltersLabel">Bộ lọc sản phẩm</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <!-- Copy nội dung filter từ sidebar vào đây cho mobile -->
    <div class="mobile-filter-content">
      <!-- Nội dung filter giống sidebar sẽ được copy vào đây qua JavaScript -->
    </div>
  </div>
</div>

@endsection

@push('css')
<style>
  /* Container styling */
  .container-xxl {
    max-width: 1320px;
  }

  /* Breadcrumb */
  .breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
  }

  .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    font-weight: bold;
  }

  .breadcrumb a {
    color: #007bff;
    text-decoration: none;
  }

  .breadcrumb a:hover {
    text-decoration: underline;
  }

  /* Sticky sidebar */
  .filter-sidebar {
    position: sticky;
    top: 20px;
    height: fit-content;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    border: 1px solid #e9ecef;
  }

  /* Category styling */
  .category-list li {
    border-bottom: 1px solid #f0f0f0;
  }

  .category-list li:last-child {
    border-bottom: none;
  }

  .category-list a {
    transition: all 0.2s ease;
    border-radius: 4px;
    position: relative;
  }

  .category-list a:hover,
  .category-list a.active {
    background-color: #e3f2fd;
    color: #007bff !important;
    padding-left: 12px;
  }

  .category-list a.active {
    font-weight: 600;
  }

  /* Product section */
  .product-section {
    border: 1px solid #e9ecef;
  }

  /* Products grid */
  .products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 30px;
  }

  /* Product card styling */
  .product-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    flex-direction: column;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  /* Product badges */
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

  /* Product image */
  .product-image {
    width: 100%;
    height: 180px;
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

  /* Product info */
  .product-info {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
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

  /* Price section */
  .product-price {
    margin-bottom: 10px;
  }

  .old-price {
    color: #999;
    text-decoration: line-through;
    font-size: 12px;
    margin-bottom: 2px;
  }

  .current-price-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .product-price .current-price {
    color: #dc3545;
    font-weight: bold;
    font-size: 18px;
  }

  .discount-badge {
    background-color: white;
    color: #dc3545;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    border: 1px solid #dc3545;
  }

  /* Rating section */
  .product-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 10px;
    flex-wrap: nowrap;
    white-space: nowrap;
  }

  .product-rating .stars {
    color: #ffc107;
    display: flex;
    gap: 2px;
  }

  .rating-text {
    color: #666;
    font-size: 12px;
  }

  /* Action buttons */
  .product-actions {
    margin-top: auto;
  }

  .add-to-cart-form {
    flex: 1;
  }

  .add-to-cart-btn {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
  }

  .add-to-cart-btn:hover {
    background-color: #218838;
    transform: scale(1.05);
  }

  .add-to-cart-btn:active {
    transform: scale(0.95);
  }

  .product-detail-btn {
    flex: 1;
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 0;
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
    min-width: 0;
    height: 40px;
    text-decoration: none;
  }

  .product-detail-btn:hover {
    background: #0056b3;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    color: white;
    text-decoration: none;
  }

  /* Product link overlay */
  .product-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: calc(100% - 60px);
    z-index: 1;
  }

  /* Pagination */
  .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  /* Scrollbar styling */
  .filter-sidebar::-webkit-scrollbar {
    width: 6px;
  }

  .filter-sidebar::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 3px;
  }

  .filter-sidebar::-webkit-scrollbar-thumb {
    background: #dee2e6;
    border-radius: 3px;
  }

  .filter-sidebar::-webkit-scrollbar-thumb:hover {
    background: #adb5bd;
  }

  /* Responsive */
  @media (max-width: 1200px) {
    .filter-sidebar {
      position: static;
      max-height: none;
      margin-bottom: 20px;
    }

    .product-image {
      height: 220px;
      padding: 18px;
    }

    .products-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (max-width: 768px) {
    .product-info {
      padding: 14px;
    }

    .product-title {
      font-size: 13px;
    }

    .current-price {
      font-size: 15px;
    }

    .product-image {
      height: 180px;
      padding: 16px;
    }

    .container-xxl {
      padding-left: 15px;
      padding-right: 15px;
    }

    .products-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 576px) {
    .product-image {
      height: 140px;
      padding: 14px;
    }

    .product-info {
      padding: 12px;
    }

    .product-title {
      font-size: 12px;
      height: 2.4em;
    }

    .current-price {
      font-size: 14px;
    }

    .add-to-cart-btn,
    .product-detail-btn {
      padding: 8px 0;
      font-size: 12px;
      height: 36px;
    }
    .product-detail-btn span,
    .add-to-cart-btn span {
      display: none;
    }

    .products-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
    }
  }

  /* Mobile filter offcanvas */
  .offcanvas-body {
    padding: 1rem;
  }

  .mobile-filter-content {
    /* Copy styles from filter-sidebar */
  }

  @media (max-width: 1400px) {
    .container-xxl {
      max-width: 1140px;
    }
  }

  @media (max-width: 992px) {
    .container-xxl {
      max-width: 720px;
    }
  }

  @media (max-width: 768px) {
    .container-xxl {
      max-width: 540px;
    }
  }

  @media (max-width: 576px) {
    .container-xxl {
      max-width: none;
    }
  }

  .form-check-input, .form-check-label {
    pointer-events: auto !important;
    position: static !important;
    z-index: 2 !important;
  }
  .form-check {
    position: relative;
    z-index: 2;
  }

  .product-price .old-price {
    text-decoration: line-through;
    color: #6c757d;
    font-size: 14px;
  }

  .current-price-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .product-price .current-price {
    color: #dc3545;
    font-weight: bold;
    font-size: 18px;
  }

  .discount-badge {
    background-color: white;
    color: #dc3545;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    border: 1px solid #dc3545;
  }

  .product-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    color: #6c757d;
    margin-bottom: 10px;
    flex-wrap: nowrap;
    white-space: nowrap;
  }

  .product-rating .stars {
    color: #ffc107;
    display: flex;
    gap: 2px;
  }

  .rating-text {
    color: #666;
    font-size: 12px;
  }
</style>
@endpush

<!-- Đặt script filter trực tiếp để luôn nhận được hàm applyFilters -->
<script>
function applyFilters() {
    // Lấy tất cả checkbox thương hiệu và giá
    const brandCheckboxes = document.querySelectorAll('input[name="brand[]"]');
    const priceCheckboxes = document.querySelectorAll('input[name="price[]"]');

    // Lấy các giá trị được chọn
    const brands = [];
    brandCheckboxes.forEach(cb => { if (cb.checked) brands.push(cb.value); });

    const prices = [];
    priceCheckboxes.forEach(cb => { if (cb.checked) prices.push(cb.value); });

    // Lấy URL gốc (không query string)
    let url = window.location.origin + window.location.pathname;
    let params = new URLSearchParams();

    brands.forEach(brand => params.append('brand[]', brand));
    prices.forEach(price => params.append('price[]', price));

    // Nếu có sort thì giữ lại
    const sortSelect = document.querySelector('select[name="sort"]');
    if (sortSelect && sortSelect.value) {
        params.set('sort', sortSelect.value);
    }

    // Chuyển hướng
    window.location.href = url + (params.toString() ? '?' + params.toString() : '');
}

function resetFilters() {
    // Lấy URL hiện tại
    let url = new URL(window.location.href);

    // Xóa tất cả các tham số filter
    url.searchParams.delete('brand');
    url.searchParams.delete('price');
    url.searchParams.delete('sort');

    // Bỏ chọn tất cả checkbox
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });

    // Reset select box về giá trị mặc định
    document.querySelector('select[name="sort"]').value = '';

    // Chuyển hướng đến URL mới
    window.location.href = url.toString();
}

function sortProducts(value) {
    // Lấy URL hiện tại
    let url = new URL(window.location.href);

    // Cập nhật tham số sort
    if (value) {
        url.searchParams.set('sort', value);
    } else {
        url.searchParams.delete('sort');
    }

    // Chuyển hướng đến URL mới
    window.location.href = url.toString();
}

document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra và đánh dấu các checkbox đã được chọn từ URL
    const urlParams = new URLSearchParams(window.location.search);

    // Đánh dấu các checkbox thương hiệu
    urlParams.getAll('brand[]').forEach(brand => {
        const checkbox = document.querySelector(`input[name="brand[]"][value="${brand}"]`);
        if (checkbox) checkbox.checked = true;
    });

    // Đánh dấu các checkbox giá
    urlParams.getAll('price[]').forEach(price => {
        const checkbox = document.querySelector(`input[name="price[]"][value="${price}"]`);
        if (checkbox) checkbox.checked = true;
    });

    // Đánh dấu select box sắp xếp
    const sortValue = urlParams.get('sort');
    if (sortValue) {
        const select = document.querySelector('select[name="sort"]');
        if (select) select.value = sortValue;
    }
});
</script>
