@extends('client.layouts.app')
@section('content')
    {{-- @include('client.layouts.blocks.banner') --}}

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
                    <div class="filter-sidebar bg-white p-0 rounded shadow-sm">
                        <div class="accordion" id="filterAccordion">
                            <!-- Danh mục -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingCategory">
                                    <button class="accordion-button py-2 px-3 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="true"
                                        aria-controls="collapseCategory">
                                        <i class="fas fa-list me-2 text-primary"></i> Danh mục sản phẩm
                                    </button>
                                </h2>
                                <div id="collapseCategory" class="accordion-collapse collapse show"
                                    aria-labelledby="headingCategory" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body py-2 px-3">
                                        <ul class="list-unstyled category-list mb-0">
                                            @foreach ($danhmucs ?? [] as $dm)
                                                @if (is_object($dm))
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
                                </div>
                            </div>
                            <!-- Thương hiệu -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingBrand">
                                    <button class="accordion-button py-2 px-3 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseBrand" aria-expanded="false"
                                        aria-controls="collapseBrand">
                                        <i class="fas fa-tags me-2 text-primary"></i> Thương hiệu
                                    </button>
                                </h2>
                                <div id="collapseBrand" class="accordion-collapse collapse" aria-labelledby="headingBrand"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body py-2 px-3">
                                        @foreach ($thuongHieus ?? [] as $brand)
                                            @if (is_object($brand))
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input form-check-input-sm filter-checkbox"
                                                        type="checkbox" id="brand_{{ $brand->id }}" name="brand[]"
                                                        value="{{ $brand->id }}"
                                                        {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label small"
                                                        for="brand_{{ $brand->id }}">{{ $brand->ten }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Giá -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingPrice">
                                    <button class="accordion-button py-2 px-3 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePrice" aria-expanded="false"
                                        aria-controls="collapsePrice">
                                        <i class="fas fa-money-bill-wave me-2 text-primary"></i> Lọc giá
                                    </button>
                                </h2>
                                <div id="collapsePrice" class="accordion-collapse collapse" aria-labelledby="headingPrice"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body py-2 px-3">
                                        <div class="form-check mb-1">
                                            <input class="form-check-input form-check-input-sm filter-checkbox"
                                                type="radio" id="price1" name="price[]" value="0-5000000">
                                            <label class="form-check-label small" for="price1">
                                                < 5tr</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input form-check-input-sm filter-checkbox"
                                                type="radio" id="price2" name="price[]" value="5000000-10000000">
                                            <label class="form-check-label small" for="price2">5tr - 10tr</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input form-check-input-sm filter-checkbox"
                                                type="radio" id="price3" name="price[]" value="10000000-15000000">
                                            <label class="form-check-label small" for="price3">10tr - 15tr</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input form-check-input-sm filter-checkbox"
                                                type="radio" id="price4" name="price[]" value="15000000-20000000">
                                            <label class="form-check-label small" for="price4">15tr - 20tr</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input form-check-input-sm filter-checkbox"
                                                type="radio" id="price5" name="price[]"
                                                value="20000000-999999999">
                                            <label class="form-check-label small" for="price5">> 20tr</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- RAM -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingRam">
                                    <button class="accordion-button py-2 px-3 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseRam" aria-expanded="false"
                                        aria-controls="collapseRam">
                                        <i class="fas fa-memory me-2 text-primary"></i> RAM
                                    </button>
                                </h2>
                                <div id="collapseRam" class="accordion-collapse collapse" aria-labelledby="headingRam"
                                    data-bs-parent="#filterAccordion">
                                    <div class="accordion-body py-2 px-3">
                                        @foreach ($rams ?? [] as $ram)
                                            @if (is_object($ram))
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input form-check-input-sm filter-checkbox"
                                                        type="checkbox" id="ram_{{ $ram->id }}" name="ram[]"
                                                        value="{{ $ram->id }}"
                                                        {{ in_array($ram->id, request('ram', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label small"
                                                        for="ram_{{ $ram->id }}">{{ $ram->dung_luong }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Ổ cứng -->
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingOCung">
                                    <button class="accordion-button py-2 px-3 fw-bold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOCung" aria-expanded="false"
                                        aria-controls="collapseOCung">
                                        <i class="fas fa-hdd me-2 text-primary"></i> Ổ cứng
                                    </button>
                                </h2>
                                <div id="collapseOCung" class="accordion-collapse collapse"
                                    aria-labelledby="headingOCung" data-bs-parent="#filterAccordion">
                                    <div class="accordion-body py-2 px-3">
                                        @foreach ($oCungs ?? [] as $oCung)
                                            @if (is_object($oCung))
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input form-check-input-sm filter-checkbox"
                                                        type="checkbox" id="o_cung_{{ $oCung->id }}" name="o_cung[]"
                                                        value="{{ $oCung->id }}"
                                                        {{ in_array($oCung->id, request('o_cung', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label small"
                                                        for="o_cung_{{ $oCung->id }}">
                                                        {{ $oCung->loai }} - {{ $oCung->dung_luong }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Nút áp dụng bộ lọc -->
                        <div class="d-grid gap-2 p-3 border-top">
                            <button type="button" class="btn btn-primary  btn-sm" onclick="applyFilters()">
                                <i class="fas fa-filter"></i> Áp dụng lọc
                            </button>
                            <form action="{{ route('danhmuc.index',$id) }}" method="get">
                            <button type="submit" class="btn btn-outline-secondary btn-sm w-100">
                                <i class="fas fa-times"></i> Xóa bộ lọc
                            </button>
                            </form>
                            
                        </div>
                    </div>
                </div>

                <!-- Nội dung chính -->
                <div class="col-xl-10 col-lg-9 col-md-8">
                    <!-- Header danh sách sản phẩm -->
                    <div class="product-section bg-white rounded shadow-sm p-3 mb-3">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
                            <h5 class="fw-bold mb-0">{{ $category->ten ?? 'PC - Máy tính chơi game, Làm việc' }}</h5>
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-muted small">{{ $sanphams->total() }} sản phẩm</span>

                                <!-- Sort dropdown -->
                                <select class="form-select form-select-sm" style="width: 140px;"
                                    onchange="sortProducts(this.value)">
                                    <option value="">Sắp xếp</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá
                                        tăng dần</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá
                                        giảm dần</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất
                                    </option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- Mobile filter button -->
                        <div class="d-md-none mb-3">
                            <button class="btn btn-outline-primary btn-sm w-100" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#mobileFilters">
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
                                    $bienThe =
                                        $sp->BienTheSanPhams->firstWhere(function ($bt) {
                                            return (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                                                (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
                                        }) ?? $sp->BienTheSanPhams->first();

                                    // Tính phần trăm giảm giá
                                    $discountPercent = 0;
                                    if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia) {
                                        $discountPercent = round(
                                            (100 * ($bienThe->gia_so_sanh - $bienThe->gia)) / $bienThe->gia_so_sanh,
                                        );
                                    }
                                    $isOutOfStock = $sp->co_bien_the
                                        ? !$bienThe || $bienThe->ton_kho <= 0
                                        : $sp->so_luong <= 0;
                                @endphp

                                <div class="product-card">
                                    <div class="product-badges">
                                        @if ($isOutOfStock)
                                            <span class="product-badge" style="background:#6c757d">Hết hàng</span>
                                        @elseif ($sp->is_hot)
                                            <span class="product-badge hot-badge">
                                                <i class="fas fa-gift"></i> Quà tặng HOT
                                            </span>
                                        @elseif(rand(1, 3) == 1)
                                            <span class="product-badge bestseller-badge">
                                                <i class="fas fa-fire"></i> Bán chạy
                                            </span>
                                        @elseif(rand(1, 2) == 1)
                                            <span class="product-badge gift-badge">
                                                <i class="fas fa-gift"></i> Quà tặng
                                            </span>
                                        @endif
                                    </div>

                                    <div class="product-image">
                                        <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
                                            alt="{{ $sp->ten }}"
                                            onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                                    </div>

                                    <div class="product-info">
                                        <h3 class="product-title">{{ $sp->ten }}</h3>

                                        <div class="product-price">
                                            @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                                                <div class="old-price">{{ number_format($bienThe->gia_so_sanh) }}₫</div>
                                            @endif
                                            <div class="current-price-wrapper">
                                                <div class="current-price">
                                                    {{ number_format($bienThe->gia ?? ($sp->gia ?? 0)) }}₫</div>
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
                                            @if (Auth::check() && Auth::user()->vai_tro != 'quan_tri' )
                                        <div class="product-actions mt-2">
                                            <form action="{{ route('client.cart.add') }}" method="POST"
                                                class="add-to-cart-form" data-product-id="{{ $sp->id }}"
                                                data-variant-id="{{ $bienThe->id ?? '' }}">
                                                @csrf
                                                <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                                                <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}">
                                                <input type="hidden" name="so_luong" value="1">
                                                <button type="submit" class="add-to-cart-btn btn w-100 py-2"
                                                    @if ($isOutOfStock) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                                    <span>
                                                                        @if ($isOutOfStock)
                                                                            HẾT HÀNG
                                                                        @else
                                                                            Thêm vào giỏ
                                                                        @endif
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                    {{-- @if ($isOutOfStock)
                                                            <div class="product-actions mt-2">
                                                                <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                                                class="add-to-cart-btn btn w-100 py-2">
                                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                                    <span>HẾT HÀNG</span>
                                                                </a>
                                                            </div>
                                                        @else --}}
                                                        <div class="product-actions mt-2">
                                                            <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                                            class="add-to-cart-btn btn w-100 py-2">
                                                                <i class="fas fa-shopping-cart me-2"></i>
                                                                <span>Xem chi tiết</span>
                                                            </a>
                                                        </div>
                                                    {{-- @endif --}}
                                                    @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('sanpham.show', $sp->id) }}@if ($bienThe) {{ '?variant=' . $bienThe->id }} @endif"
                                        class="product-link"></a>
                                </div>
                            @empty
                                <div class="col-12 col-md-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Không tìm thấy sản phẩm nào</h5>
                                        <p class="text-muted">Hãy thử điều chỉnh bộ lọc hoặc tìm kiếm với từ khóa khác</p>
                                        <form action="{{ route('danhmuc.index',$id) }}" method="get">
                                            <button class="btn btn-primary" type="submit">Xóa bộ lọc</button>
                                        </form>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Phân trang -->
                        @if ($sanphams->hasPages())
                            <div class="d-flex justify-content-center my-4">
                                <nav aria-label="Page navigation example">
                                    {{ $sanphams->appends(request()->query())->links() }}
                                </nav>
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
        .pagination {
            --bs-pagination-padding-x: 1.1rem;
            /* Tăng padding ngang một chút */
            --bs-pagination-padding-y: 0.6rem;
            /* Tăng padding dọc một chút */
            --bs-pagination-font-size: 1.1rem;
            /* Đặt font-size bằng biến CSS của Bootstrap */
            --bs-pagination-border-radius: 0.75rem;
            /* Tăng bo góc cho tổng thể pagination */
            --bs-pagination-bg: #fff;
            /* Nền trắng mặc định */
            --bs-pagination-border-color: #dee2e6;
            /* Màu viền mặc định */
            --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            /* Shadow khi focus (màu đỏ) */

            /* Hiệu ứng chuyển động mượt mà cho toàn bộ pagination */
            transition: all 0.3s ease-in-out;
        }

        /* Các mục riêng lẻ (page-item) */
        .pagination .page-item {
            margin: 0 0.25rem;
            /* Khoảng cách giữa các nút */
        }

        /* Nút phân trang (page-link) */
        .pagination .page-link {
            color: #dc3545;
            /* Màu chữ mặc định là đỏ của bạn */
            border: 1px solid #dc3545;
            /* Đặt viền cùng màu chữ */
            border-radius: 0.5rem;
            /* Bo góc cho từng nút riêng lẻ */
            transition: all 0.2s ease-in-out;
            /* Hiệu ứng chuyển động khi hover */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            /* Thêm shadow nhẹ cho mỗi nút */
        }

        /* Nút phân trang khi hover */
        .pagination .page-link:hover {
            background-color: #dc3545;
            /* Nền đỏ */
            color: #fff;
            /* Chữ trắng */
            border-color: #dc3545;
            /* Viền đỏ */
            transform: translateY(-2px);
            /* Hiệu ứng nhấc nhẹ lên */
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
            /* Shadow mạnh hơn khi hover */
        }

        /* Nút phân trang khi focus (click) */
        .pagination .page-link:focus {
            box-shadow: var(--bs-pagination-focus-box-shadow);
            /* Sử dụng biến Bootstrap */
        }

        /* Nút phân trang đang active */
        .pagination .page-item.active .page-link {
            background-color: #dc3545;
            /* Nền đỏ */
            border-color: #dc3545;
            /* Viền đỏ */
            color: #fff;
            /* Chữ trắng */
            box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
            /* Shadow cho nút active */
        }

        /* Nút disable (Previous/Next khi không có) */
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            /* Màu xám cho nút bị disable */
            border-color: #dee2e6;
            /* Viền xám nhạt */
            background-color: #f8f9fa;
            /* Nền xám rất nhạt */
            cursor: not-allowed;
            /* Con trỏ không được phép */
            box-shadow: none;
            /* Bỏ shadow */
            transform: none;
            /* Bỏ hiệu ứng nhấc */
        }

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

        .breadcrumb-item+.breadcrumb-item::before {
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
            position: relative;
            z-index: 10;
        }

        .add-to-cart-form {
            flex: 1;
            position: relative;
            z-index: 10;
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
            position: relative;
            z-index: 10;
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

        .form-check-input,
        .form-check-label {
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        /* Button states */
        .add-to-cart-btn.loading {
            background: #6c757d !important;
        }

        .add-to-cart-btn.success {
            background: #28a745 !important;
        }

        .add-to-cart-btn.error {
            background: #dc3545 !important;
        }

        /* Animation keyframes */
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        .accordion-button {
            background: #f8f9fa;
            border: none;
            outline: none;
            box-shadow: none;
            font-size: 15px;
            transition: background 0.2s;
        }

        .accordion-button:not(.collapsed) {
            background: #e3f2fd;
            color: #007bff;
        }

        .accordion-item {
            border-radius: 8px;
            margin-bottom: 8px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }

        .accordion-body {
            background: #fff;
        }

        .form-check-input.filter-checkbox:checked+.form-check-label,
        .form-check-input.filter-checkbox:checked~.form-check-label {
            color: #fff !important;
            background: #007bff;
            border-radius: 4px;
            padding-left: 8px;
            padding-right: 8px;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }

        .form-check-label {
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }

        .form-check-input.filter-checkbox:hover+.form-check-label,
        .form-check-label:hover {
            background: #e3f2fd;
            color: #007bff;
        }

        .form-check-input.filter-checkbox {
            cursor: pointer;
            border-radius: 3px;
            border: 1px solid #b0b0b0;
            margin-top: 2px;
            margin-right: 6px;
            transition: border 0.2s;
        }

        .form-check-input.filter-checkbox:focus {
            border: 1.5px solid #007bff;
            box-shadow: 0 0 0 0.1rem #007bff33;
        }

        .accordion-button .fa-list,
        .accordion-button .fa-tags,
        .accordion-button .fa-money-bill-wave,
        .accordion-button .fa-memory,
        .accordion-button .fa-hdd {
            font-size: 1.1em;
            vertical-align: middle;
        }

        .accordion-button.collapsed {
            color: #333;
        }

        .accordion-button:after {
            color: #007bff;
        }

        .accordion {
            --bs-accordion-bg: none;
            --bs-accordion-border-color: none;
        }

        .category-list a.active {
            background: #007bff !important;
            color: #fff !important;
            font-weight: 600;
            padding-left: 12px;
        }

        .category-list a:hover {
            background: #e3f2fd;
            color: #007bff !important;
        }
        /* Đảm bảo phần empty chiếm toàn bộ chiều rộng trên mobile */
        @media (max-width: 767.98px) {
            .products-grid .col-12 {
                grid-column: 1 / -1; /* Chiếm toàn bộ cột trong grid */
                width: 100%;
            }
        }

        /* Đảm bảo .products-grid không ảnh hưởng khi empty */
        .products-grid:empty,
        .products-grid > :only-child {
            display: block; /* Hoặc flex nếu cần */
            width: 100%;
        }
    </style>
@endpush

<!-- Đặt script filter trực tiếp để luôn nhận được hàm applyFilters -->
@push('js')
    <script>
        function applyFilters() {
            // Lấy tất cả checkbox thương hiệu và giá
            const brandCheckboxes = document.querySelectorAll('input[name="brand[]"]');
            const priceCheckboxes = document.querySelectorAll('input[name="price[]"]');
            // Lấy các giá trị được chọn
            const brands = [];
            brandCheckboxes.forEach(cb => {
                if (cb.checked) brands.push(cb.value);
            });
            const prices = [];
            priceCheckboxes.forEach(cb => {
                if (cb.checked) prices.push(cb.value);
            });
            // Lấy các checkbox ram và o_cung
            const ramCheckboxes = document.querySelectorAll('input[name="ram[]"]');
            const oCungCheckboxes = document.querySelectorAll('input[name="o_cung[]"]');
            const rams = [];
            ramCheckboxes.forEach(cb => {
                if (cb.checked) rams.push(cb.value);
            });
            const oCungs = [];
            oCungCheckboxes.forEach(cb => {
                if (cb.checked) oCungs.push(cb.value);
            });
            // Lấy URL gốc (không query string)
            let url = window.location.origin + window.location.pathname;
            let params = new URLSearchParams();
            brands.forEach(brand => params.append('brand[]', brand));
            prices.forEach(price => params.append('price[]', price));
            rams.forEach(ram => params.append('ram[]', ram));
            oCungs.forEach(o_cung => params.append('o_cung[]', o_cung));
            // Nếu có sort thì giữ lại
            const sortSelect = document.querySelector('select[name="sort"]');
            if (sortSelect && sortSelect.value) {
                params.set('sort', sortSelect.value);
            }
            // Chuyển hướng
            window.location.href = url + (params.toString() ? '?' + params.toString() : '');
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
            // Đánh dấu các checkbox ram
            urlParams.getAll('ram[]').forEach(ram => {
                const checkbox = document.querySelector(`input[name="ram[]"][value="${ram}"]`);
                if (checkbox) checkbox.checked = true;
            });
            // Đánh dấu các checkbox o_cung
            urlParams.getAll('o_cung[]').forEach(o_cung => {
                const checkbox = document.querySelector(`input[name="o_cung[]"][value="${o_cung}"]`);
                if (checkbox) checkbox.checked = true;
            });
            // Đánh dấu select box sắp xếp
            const sortValue = urlParams.get('sort');
            if (sortValue) {
                const select = document.querySelector('select[name="sort"]');
                if (select) select.value = sortValue;
            }

            // Add cart form event listeners
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    addToCart(this);
                });
            });

            // Prevent product link from being triggered when clicking add to cart button
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        });

        function addToCart(form) {
            const button = form.querySelector('.add-to-cart-btn');
            const originalContent = button.innerHTML;

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                showToast('Lỗi: Không tìm thấy CSRF token!', 'error');
                return;
            }

            button.className = 'add-to-cart-btn loading';
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Đang thêm...</span>';

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
                        return response.json().then(err => {
                            throw new Error(err.message || `Lỗi ${response.status}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        button.className = 'add-to-cart-btn success';
                        button.innerHTML = '<i class="fas fa-check"></i> <span>Đã thêm!</span>';

                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount && data.cart_count) {
                            cartCount.textContent = data.cart_count;
                        }

                        showToast(data.message || 'Đã thêm sản phẩm vào giỏ hàng!', 'success');
                    } else {
                        if (data.redirect) {
                            showToast('Đang chuyển đến trang đăng nhập...', 'info');
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 1000);
                            return;
                        }
                        throw new Error(data.message || 'Có lỗi xảy ra từ máy chủ');
                    }
                })
                .catch(error => {
                    button.className = 'add-to-cart-btn error';
                    button.innerHTML = '<i class="fas fa-times"></i> <span>Lỗi!</span>';
                    showToast(error.message || 'Có lỗi khi thêm vào giỏ hàng!', 'error');
                })
                .finally(() => {
                    setTimeout(() => {
                        button.className = 'add-to-cart-btn';
                        button.disabled = false;
                        button.innerHTML = originalContent;
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

            container.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => toast.remove(), 5000);
        }
    </script>
@endpush
