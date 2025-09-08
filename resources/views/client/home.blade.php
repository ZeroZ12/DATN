@extends('client.layouts.app')
@section('content')
    @include('client.layouts.blocks.banner')
    <section class="product-section container py-4 ">
        <div class=" text-center mb-5">
            <h1 class="fw-bold text-primary">FLASH SALE 🔥
                @if ($activeSaleEvents->isNotEmpty() && $activeSaleEvents->first()->suKien->hien_thi)
                    <span class="countdown fs-5 text-danger fw-bold"
                        data-end-time="{{ $activeSaleEvents->first()->suKien->ngay_ket_thuc->toIso8601String() }}"
                        data-id="{{ $activeSaleEvents->first()->id }}"></span>
                @endif
            </h1>
        </div>

        @if ($activeSaleEvents->isEmpty() || !$activeSaleEvents->contains(fn($event) => $event->suKien->hien_thi))
            <div class="product-section alert alert-info text-center">
                Hiện không có sản phẩm nào đang sale. Hãy quay lại sau nhé!
            </div>
        @else
            <div class="products-slider-wrapper position-relative">
                <button type="button" class="slider-btn left" onclick="scrollProducts(this, -1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-slider d-flex overflow-hidden">
                    @foreach ($activeSaleEvents as $saleEvent)
                        @if ($saleEvent->suKien->hien_thi)
                            @php
                                $sp = $saleEvent->sanPham ?? $saleEvent->bienTheSanPham->sanPham;
                                $bienThe = $saleEvent->bienTheSanPham;
                                $soLuongConLai = $saleEvent->so_luong_gioi_han ?? ($bienThe->so_luong_gioi_han ?? $sp->so_luong_gioi_han);
                                $isOutOfStockSale = $soLuongConLai <= 0;

                                $gia = $bienThe ? $bienThe->gia : $sp->gia;
                                $gia_so_sanh = $saleEvent->gia_goc_khi_bat_dau ?? $gia;
                                $isOutOfStock = $bienThe ? $bienThe->ton_kho <= 0 : $sp->so_luong <= 0;
                                $avgRating = $sp->danh_gia_san_phams_avg_so_sao ?? 0;
                                $reviewCount = $sp->danh_gia_san_phams_count ?? 0;
                                $discountPercent =
                                    $gia_so_sanh > 0 && $saleEvent->gia_su_kien < $gia_so_sanh
                                        ? number_format(
                                            (($gia_so_sanh - $saleEvent->gia_su_kien) / $gia_so_sanh) * 100,
                                            0,
                                        )
                                        : 0;
                            @endphp

                            <div class="product-card col mx-2 shadow-sm rounded-3 position-relative"
                                style="transition: transform 0.3s;">
                                <div class="product-badges position-absolute top-0 start-0 p-2">
                                    @if ($discountPercent > 0)
                                        <span class="product-badge bg-danger text-white rounded-pill px-2 py-1">
                                            Sale {{ $discountPercent }}%
                                        </span>
                                    @endif
                                    @if ($isOutOfStockSale)
                                        <span class="product-badge bg-secondary text-white rounded-pill px-2 py-1 mt-1">Hết hàng</span>
                                    @elseif ($sp->is_hot)
                                        <span class="product-badge bg-warning text-dark rounded-pill px-2 py-1 mt-1">
                                            <i class="fas fa-gift"></i> Quà tặng HOT
                                        </span>
                                    @endif
                                </div>
                                <div class="product-image overflow-hidden rounded-top">
                                    <img src="{{ $sp->anh_dai_dien ? asset('storage/' . $sp->anh_dai_dien) : asset('images/no-image.png') }}"
                                        alt="{{ $sp->ten }}" class="img-fluid w-100"
                                        style="height: 200px; object-fit: cover;"
                                        onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                                </div>
                                <div class="product-info p-3">
                                    <h3 class="product-title fs-6 fw-bold">{{ Str::limit($sp->ten, 50) }}</h3>
                                    <div class="product-price mb-2">
                                        @if ($gia_so_sanh > $saleEvent->gia_su_kien)
                                            <div class="old-price text-muted text-decoration-line-through fs-6">
                                                {{ number_format($gia_so_sanh) }}₫
                                            </div>
                                        @endif
                                        <div class="current-price-wrapper d-flex align-items-center gap-2">
                                            <div class="current-price text-primary fw-bold fs-5">
                                                {{ number_format($saleEvent->gia_su_kien) }}₫
                                            </div>
                                            @if ($gia_so_sanh > $saleEvent->gia_su_kien)
                                                <div
                                                    class="discount-badge bg-danger text-white rounded-pill px-2 py-1 fs-6">
                                                    -{{ $discountPercent }}%
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-rating">
                                        <span class="rating-score">{{ number_format($avgRating, 1) }}</span>
                                        <i class="fas fa-star text-warning"></i>
                                        <span class="rating-text">({{ $reviewCount }} đánh giá)</span>
                                    </div>
                                    @if ($saleEvent->so_luong_gioi_han)
                                        <p class="card-text text-warning fw-bold">
                                            <i class="bi bi-lightning-fill"></i> Chỉ còn
                                            {{ $saleEvent->so_luong_gioi_han }} sản phẩm!
                                        </p>
                                    @endif
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
                                                    @if ($isOutOfStockSale) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                    <span>
                                                        @if ($isOutOfStockSale)
                                                            HẾT HÀNG
                                                        @else
                                                            Thêm vào giỏ
                                                        @endif
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="product-actions mt-2">
                                            <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                               class="add-to-cart-btn btn w-100 py-2">
                                                <i class="fas fa-shopping-cart me-2"></i>
                                                <span>Xem chi tiết</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                    class="product-link position-absolute top-0 start-0 w-100 h-100"></a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button type="button" class="slider-btn right" onclick="scrollProducts(this, 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            {{-- @if ($activeSaleEvents->hasPages())
                <div class="pagination-wrapper mt-5 d-flex justify-content-center">
                    {{ $activeSaleEvents->links('pagination::bootstrap-5') }}
                </div>
            @endif --}}
        @endif
    </section>
    <div class="container py-4">
        @foreach ($danhMucs as $danhMuc)
            @if ($sanphams->where('id_category', $danhMuc->id)->isNotEmpty())
                <div class="product-section mb-4">
                    <div class="row section-header align-items-center">
                        <h2 class="col-7 section-title mb-0">{{ $danhMuc->ten }}</h2>
                        <a class="col-5 dm text-end pe-5" href="{{ route('danhmuc.index', $danhMuc->id) }}">Xem Tất Cả</a>
                        <form method="GET" action="{{ route('client.home') }}" class="filter-form"></form>
                    </div>
                    <div class="products-slider-wrapper">
                        <button type="button" class="slider-btn left" onclick="scrollProducts(this, -1)"><i
                                class="fas fa-chevron-left"></i></button>
                        <div class="products-slider">
                            @foreach ($sanphams->where('id_category', $danhMuc->id) as $sp)
                                @php
                                    if ($sp->co_bien_the) {
                                        $bienThe =
                                            $sp->BienTheSanPhams->firstWhere(function ($bt) {
                                                return (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                                                    (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
                                            }) ?? $sp->BienTheSanPhams->first();
                                        $gia = $bienThe ? $bienThe->gia : 0;
                                        $gia_so_sanh = $bienThe ? $bienThe->gia_so_sanh : null;
                                        $isOutOfStock = !$bienThe || $bienThe->ton_kho <= 0;
                                    } else {
                                        $bienThe = null;
                                        $gia = $sp->gia;
                                        $gia_so_sanh = $sp->gia_so_sanh;
                                        $isOutOfStock = $sp->so_luong <= 0;
                                    }
                                @endphp
                                <div class="product-card col">
                                    <div class="product-badges">
                                        @if ($isOutOfStock)
                                            <span class="product-badge" style="background:#6c757d">Hết hàng</span>
                                        @endif
                                        @if (in_array($sp->id, $sanPhamBanChay))
                                            <span class="product-badge bestseller-badge">
                                                <i class="fas fa-fire"></i> Bán chạy
                                            </span>
                                        @elseif ($sp->is_hot)
                                            <span class="product-badge hot-badge">
                                                <i class="fas fa-gift"></i> Quà tặng HOT
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
                                            @if ($gia_so_sanh && $gia_so_sanh > $gia)
                                                <div class="old-price">{{ number_format($gia_so_sanh) }}₫</div>
                                            @endif
                                            <div class="current-price-wrapper">
                                                <div class="current-price">{{ number_format($gia) }}₫</div>
                                                @if ($gia_so_sanh && $gia_so_sanh > $gia)
                                                    <div class="discount-badge">
                                                        -{{ round((100 * ($gia_so_sanh - $gia)) / $gia_so_sanh) }}%
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
                                           @if (Auth::check() && Auth::user()->vai_tro !== 'quan_tri')
                                                <div class="product-actions mt-2">
                                                    <form action="{{ route('client.cart.add') }}" method="POST"
                                                        class="add-to-cart-form" data-product-id="{{ $sp->id }}"
                                                        data-variant-id="{{ $bienThe->id ?? '' }}">
                                                        @csrf
                                                        <input type="hidden" name="san_pham_id"
                                                            value="{{ $sp->id }}">
                                                        <input type="hidden" name="bien_the_id"
                                                            value="{{ $bienThe->id ?? '' }}">
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
                                                  <div class="product-actions mt-2">
                                            <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                               class="add-to-cart-btn btn w-100 py-2">
                                                <i class="fas fa-shopping-cart me-2"></i>
                                                <span>Xem chi tiết</span>
                                            </a>
                                        </div>
                                            @endif
                                        </div>      
                                    </div>
                                    <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}"
                                        class="product-link"></a>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="slider-btn right" onclick="scrollProducts(this, 1)"><i
                                class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Chat Button -->
    <button class="chat-toggle-btn" onclick="toggleChatBox()">
        <i class="fas fa-comment-dots"></i>
    </button>

    <!-- Chat Box -->
    <div class="chat-box" id="chatBox">
        <div class="chat-header">
            <h5><i class="fa fa-message" aria-hidden="true"></i> Chat với TopPC AI</h5>
            <button class="chat-close-btn" onclick="toggleChatBox()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="chat-message bot-message">
                <p>Xin chào! Tôi là AI hỗ trợ mua sắm. Hãy nhập yêu cầu của bạn (VD: "Tôi muốn một chiếc Màn hình giá dưới
                    500k") để tôi tìm sản phẩm phù hợp!</p>
            </div>
        </div>
        <div class="chat-footer">
            <form id="chatForm" action="{{ route('chat.search') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input id="message" type="text" name="message" class="form-control"
                        placeholder="Nhập yêu cầu của bạn..." required>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('css')
        <style>
            body {
                background-color: #f8f9fa;
                font-family: "Quicksand", sans-serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;
            }

            .product-section:nth-child(1) {
                background: url("{{ asset('assets/images/background.jpg') }}") no-repeat;
                background-size: cover;
                background-position: center;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .dm {
                color: black;
                text-decoration: none;
                font-weight: 500;
                line-height: 1;
            }

            .dm:hover {
                text-decoration: underline;
            }

            .product-section:nth-child(1) .dm {
                color: white;
                text-decoration: none;
                font-weight: 500;
            }

            .product-section:nth-child(1) .dm:hover {
                text-decoration: underline;
            }

            .product-section {
                background: white;
                background-size: cover;
                background-position: center;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .section-header {
                margin-bottom: 20px;
                display: flex;
                align-items: center;
            }

            .product-section:nth-child(1) .section-title {
                color: #ffffff;
                text-transform: uppercase;
                margin-bottom: 0;
                padding: 10px 0 0 35px;
            }

            .section-title {
                color: #333;
                text-transform: uppercase;
                margin-bottom: 0;
                padding: 10px 0 0 35px;
            }

            .products-slider-wrapper {
                position: relative;
                display: flex;
                align-items: center;
                margin-bottom: 30px;
            }

            .products-slider {
                display: flex;
                gap: 15px;
                overflow-x: auto;
                scroll-behavior: smooth;
                padding-bottom: 10px;
                width: 100%;
                -webkit-overflow-scrolling: touch;
            }

            .product-card {
                min-width: 270px;
                max-width: 270px;
                flex: 0 0 270px;
                position: relative;
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: all 0.3s ease;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .product-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
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
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                transition: background 0.2s;
            }

            .slider-btn.left {
                margin-right: 10px;
            }

            .slider-btn.right {
                margin-left: 10px;
            }

            .slider-btn:hover {
                background: #f0f0f0;
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
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

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

            .add-to-cart-btn:disabled {
                cursor: not-allowed;
                pointer-events: none;
                opacity: 0.8;
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
                margin-bottom: 0;
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

            /* Chat Box Styles */
            .chat-toggle-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #DC3545;
                color: white;
                border: none;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 1000;
            }

            .chat-toggle-btn:hover {
                background: #8D0107;
                transform: scale(1.1);
            }

            .chat-box {
                position: fixed;
                bottom: 100px;
                right: 20px;
                width: 350px;
                max-height: 500px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
                display: none;
                flex-direction: column;
                z-index: 1000;
                overflow: hidden;
            }

            .chat-box.active {
                display: flex;
            }

            .chat-header {
                background: #DC3545;
                color: white;
                padding: 15px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
            }

            .chat-header h5 {
                margin: 0;
                font-size: 16px;
                font-weight: 600;
            }

            .chat-close-btn {
                background: none;
                border: none;
                color: white;
                font-size: 16px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .chat-close-btn:hover {
                color: #f0f0f0;
            }

            .chat-body {
                flex: 1;
                padding: 15px;
                overflow-y: auto;
                background: #f8f9fa;
                max-height: 400px;
            }

            .chat-message {
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 8px;
                font-size: 14px;
                line-height: 1.5;
            }

            .bot-message {
                background: #e9ecef;
                color: #333;
                margin-right: 10px;
            }

            .user-message {
                background: #DC3545;
                color: white;
                margin-left: 10px;
                text-align: right;
            }

            .chat-footer {
                padding: 10px;
                background: white;
                border-top: 1px solid #e9ecef;
            }

            .chat-footer .input-group {
                display: flex;
                align-items: center;
            }

            .chat-footer input {
                border-radius: 20px;
                border: 1px solid #e9ecef;
                padding: 8px 15px;
                font-size: 14px;
            }

            .chat-footer button {
                border-radius: 20px;
                padding: 8px 15px;
                font-size: 14px;
                margin-left: 10px;
            }

            @media (max-width: 576px) {
                .chat-box {
                    width: 90%;
                    right: 5%;
                    bottom: 80px;
                }

                .chat-toggle-btn {
                    width: 50px;
                    height: 50px;
                    font-size: 20px;
                }
            }

            /* Media Queries for Mobile */
            @media (max-width: 768px) {
                .product-card {
                    min-width: 240px;
                    max-width: 240px;
                    flex: 0 0 240px;
                }

                .product-image {
                    height: 180px;
                }

                .product-title {
                    font-size: 13px;
                    height: 36px;
                }

                .product-price .current-price {
                    font-size: 16px;
                }

                .old-price {
                    font-size: 11px;
                }

                .discount-badge {
                    font-size: 11px;
                    padding: 2px 6px;
                }

                .product-rating {
                    font-size: 12px;
                }

                .rating-text {
                    font-size: 11px;
                }

                .add-to-cart-btn {
                    padding: 8px 12px;
                    font-size: 13px;
                }

                .products-slider-wrapper {
                    padding: 10px 5px;
                }

                .products-slider {
                    gap: 10px;
                }

                .slider-btn {
                    width: 32px;
                    height: 32px;
                    font-size: 16px;
                }
            }

            @media (max-width: 576px) {
                .product-card {
                    min-width: 200px;
                    max-width: 200px;
                    flex: 0 0 200px;
                }

                .product-image {
                    height: 160px;
                }

                .product-title {
                    font-size: 12px;
                    height: 34px;
                }

                .product-price .current-price {
                    font-size: 15px;
                }

                .old-price {
                    font-size: 10px;
                }

                .discount-badge {
                    font-size: 10px;
                    padding: 2px 5px;
                }

                .product-rating {
                    font-size: 11px;
                }

                .rating-text {
                    font-size: 10px;
                }

                .add-to-cart-btn {
                    padding: 7px 10px;
                    font-size: 12px;
                }

                .products-slider-wrapper {
                    padding: 8px 3px;
                }

                .products-slider {
                    gap: 8px;
                }

                .slider-btn {
                    width: 30px;
                    height: 30px;
                    font-size: 14px;
                }

                .dm {
                    /* display: flex;
                        float: left;
                        font-size: 10px; */
                }
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

            @media (max-width: 768px) {
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
                .toast-content {
                    padding: 10px 12px;
                    font-size: 12px;
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }

            @keyframes bounce {

                0%,
                20%,
                60%,
                100% {
                    transform: translateY(0);
                }

                40% {
                    transform: translateY(-10px);
                }

                80% {
                    transform: translateY(-5px);
                }
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                10%,
                30%,
                50%,
                70%,
                90% {
                    transform: translateX(-5px);
                }

                20%,
                40%,
                60%,
                80% {
                    transform: translateX(5px);
                }
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

            @keyframes progress {
                from {
                    width: 100%;
                }

                to {
                    width: 0%;
                }
            }
        </style>
    @endpush

    @push('js')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/ffb3c051a8.js" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    showToast("{{ session('success') }}", 'success');
                @endif

                @if (session('error'))
                    showToast("{{ session('error') }}", 'error');
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        showToast("{{ $error }}", 'error');
                    @endforeach
                @endif
                // chuyển lịch sử chatbot qua db sau khi đăng nhập
                @if(Auth::check() && Auth::user()->vai_tro !== 'quan_tri')
                const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
                if (chatHistory.length >0)
                 {
                    fetch('/chat/import-history',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({history: chatHistory})
                    }).then(res => res.json())
                    .then(data => {
                            if (data.success){
                                localStorage.removeItem('chatHistory');
                            }
                    });
                 }
                 @endif
                document.querySelectorAll('.add-to-cart-form').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        try {
                            addToCart(this);
                        } catch (e) {
                            console.error('A critical error occurred while trying to call addToCart:',
                                e);
                            showToast('Lỗi nghiêm trọng. Vui lòng kiểm tra Console.', 'error');
                        }
                    });
                });

                // Handle chat form submission
                const chatForm = document.getElementById('chatForm');
                if (chatForm) {
                    chatForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        const messageInput = chatForm.querySelector('input[name="message"]');
                        const message = messageInput.value.trim();
                        if (!message) return;

                        // Add user message to chat
                        const chatBody = document.getElementById('chatBody');
                        const userMessage = document.createElement('div');
                        userMessage.className = 'chat-message user-message';
                        userMessage.innerHTML = `<p>${message}</p>`;
                        chatBody.appendChild(userMessage);
                        chatBody.scrollTop = chatBody.scrollHeight;



                        // Show loading
                        const loadingMessage = document.createElement('div');
                        loadingMessage.className = 'chat-message bot-message';
                        loadingMessage.innerHTML =
                        '<p><i class="fas fa-spinner fa-spin"></i> Đang xử lý...</p>';
                        chatBody.appendChild(loadingMessage);
                        chatBody.scrollTop = chatBody.scrollHeight;

                        // Send AJAX request
                        const formData = new FormData(chatForm);

                        fetch(chatForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().then(err => {
                                        throw new Error(err.message || 'Lỗi khi gọi API');
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Remove loading message
                                loadingMessage.remove();

                                // Add bot response
                                const botMessage = document.createElement('div');
                                botMessage.className = 'chat-message bot-message';
                                botMessage.innerHTML = `<p>${data.message}</p>`;
                                chatBody.appendChild(botMessage);
                                chatBody.scrollTop = chatBody.scrollHeight;
                                // Lưu lịch sử chat vào localStorage nếu chưa đăng nhập
                                @if (!Auth::check())
                                    let chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
                                    chatHistory.push({
                                        user: message,
                                        bot: data.message,
                                        time: new Date().toISOString()
                                    });
                                    localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
                                @else
                                
                                    localStorage.removeItem('chatHistory');
                                
                                @endif
                            })
                            .catch(error => {
                                // Remove loading message
                                loadingMessage.remove();

                                // Show error
                                const errorMessage = document.createElement('div');
                                errorMessage.className = 'chat-message bot-message';
                                errorMessage.innerHTML = `<p>Lỗi: ${error.message}</p>`;
                                chatBody.appendChild(errorMessage);
                                chatBody.scrollTop = chatBody.scrollHeight;
                            });
                        // Clear input
                        messageInput.value = '';
                    });
                }
            });

            function toggleChatBox() {
                const chatBox = document.getElementById('chatBox');
                chatBox.classList.toggle('active');
            }

            function addToCart(form) {
                const button = form.querySelector('.add-to-cart-btn');
                const originalContent = button.innerHTML;

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error('FATAL: CSRF token meta tag not found.');
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
                                console.error('Server responded with an error:', err);
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
                        console.error('An error occurred in the fetch chain:', error);
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
                let container = document.querySelector('.toast-container');
                if (!container) {
                    container = document.createElement('div');
                    container.className = 'toast-container';
                    document.body.appendChild(container);
                }

                const toast = document.createElement('div');
                toast.className = `toast ${type}`;

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
                setTimeout(() => toast.remove(), 3000);
            }

            function scrollProducts(button, direction) {
                const wrapper = button.closest('.products-slider-wrapper');
                const slider = wrapper.querySelector('.products-slider');
                const card = slider.querySelector('.product-card');
                if (!card) return;

                const scrollAmount = card.offsetWidth + 20;
                slider.scrollBy({
                    left: direction * scrollAmount * 2,
                    behavior: 'smooth'
                });
            }

            function resetFilters() {
                const selects = document.querySelectorAll('.filter-tab-select');
                selects.forEach(select => {
                    select.selectedIndex = 0;
                });
                document.querySelector('.filter-form').submit();
            }

            function showFilterModal() {
                alert('Bộ lọc nâng cao - Có thể implement modal ở đây');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const countdownElements = document.querySelectorAll('.countdown');

                function updateCountdown() {
                    countdownElements.forEach(element => {
                        const endTime = new Date(element.dataset.endTime).getTime();
                        const id = element.dataset.id;
                        const now = new Date().getTime();
                        const distance = endTime - now;

                        if (distance < 0) {
                            element.innerHTML = 'Đã kết thúc!';
                            element.closest('.col-md-4').style.display = 'none';
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        element.innerHTML = `${days} ngày ${hours} giờ ${minutes} phút ${seconds} giây`;
                    });
                }

                setInterval(updateCountdown, 1000);
                updateCountdown();
            });
        </script>
    @endpush
@endsection
