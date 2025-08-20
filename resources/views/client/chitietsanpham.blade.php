@extends('client.layouts.app')

@section('content')
    <style>
        .option-btn {
            border-radius: 8px;
            border: 2px solid #ddd;
            font-weight: 600;
            padding: 8px 24px;
            background: #fff;
            position: relative;
            transition: all 0.2s;
            min-width: 110px;
        }

        .option-btn.active {
            border-color: #ffc107;
            background: #fffbe6;
            color: #b8860b;
        }

        .option-btn.active.ram::after {
            content: '';
            position: absolute;
            top: 6px;
            right: 8px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 0 solid transparent;
            border-bottom: 10px solid #ffc107;
        }

        .option-btn.active.ssd {
            border-color: #17a2b8;
            background: #e6f7fa;
            color: #117a8b;
        }

        .option-btn.active.ssd::after {
            content: '';
            position: absolute;
            top: 6px;
            right: 8px;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 0 solid transparent;
            border-bottom: 10px solid #17a2b8;
        }

        .main-img-box {
            height: 320px;
            background: #fff;
            border-radius: 12px;
            border: 1.5px solid #eee;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-img {
            max-height: 95%;
            max-width: 95%;
            object-fit: contain;
            border-radius: 10px;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            background: #fafbfc;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .main-img.current {
            z-index: 2;
        }

        .main-img.next {
            z-index: 1;
            transform: translate(150%, -50%);
        }

        .main-img.sliding {
            transform: translate(-150%, -50%);
        }

        .main-img:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
        }

        .thumb-list {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .img-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #eee;
            cursor: pointer;
            transition: border 0.2s, box-shadow 0.2s, transform 0.2s;
            background: #fff;
        }

        .img-thumb.active,
        .img-thumb:hover {
            border: 2.5px solid #dc3545;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.10);
            transform: scale(1.05);
        }

        #sp-tuong-tu .sp-card {
            border-radius: 14px;
            transition: box-shadow 0.2s, transform 0.2s;
            overflow: hidden;
            background: #fff;
            min-height: 320px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #sp-tuong-tu .sp-card:hover {
            box-shadow: 0 6px 24px rgba(220, 53, 69, 0.12), 0 1.5px 6px rgba(0, 0, 0, 0.04);
            transform: translateY(-4px) scale(1.03);
        }

        #sp-tuong-tu .sp-card-img-box {
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
            overflow: hidden;
            height: 160px;
        }

        #sp-tuong-tu .sp-card-img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.3s;
        }

        #sp-tuong-tu .sp-card:hover .sp-card-img {
            transform: scale(1.07);
        }

        #sp-tuong-tu .card-body {
            padding: 1rem 0.7rem 1.2rem 0.7rem;
        }

        #sp-tuong-tu .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }

        .product-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            min-width: 0;
        }

        .product-badges {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
        }

        .product-image {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            overflow: hidden;
            padding: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 0;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 15px;
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

        .flash-sale-badge {
            background: #ff4500;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }

        .flash-sale-timer {
            font-size: 14px;
            color: #ff4500;
            font-weight: bold;
            margin-top: 5px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .rating-score {
            font-weight: bold;
            font-size: 14px;
        }

        .product-rating .fas.fa-star {
            font-size: 13px;
        }

        .rating-text {
            font-size: 13px;
            color: #666;
        }

        .current-price-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
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
        }

        .add-to-cart-btn:hover {
            background: #218838;
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

        .product-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% - 60px);
            z-index: 1;
        }

        .collapsed-mo-ta {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            position: relative;
            max-height: 7.2em;
        }

        .collapsed-mo-ta {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            position: relative;
            max-height: 7.2em;
        }

        .expanded-mo-ta {
            display: block;
            max-height: none;
        }
        .expanded-mo-ta {
            display: block;
            max-height: none;
        }

        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .product-image {
                height: 160px;
            }
        }

        @media (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .product-image {
                height: 140px;
            }
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

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
                height: 120px;
            }
        }

        @media (max-width: 576px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 100px;
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
        }

        .bestseller-badge {
            background: #dc3545;
            color: #fff;
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }

        .gift-badge {
            background: #28a745;
            color: #fff;
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }

        .rating-stars {
            font-size: 1.5rem;
            color: #ccc;
            cursor: pointer;
            display: inline-block;
        }

        .rating-stars .star {
            color: #ffd700;
            transition: color 0.2s;~
        }

        .rating-stars .star:hover,
        .rating-stars .star.selected {
            color: #ffc107;
        }

        .rating-stars .star:hover~.star:not(.selected) {
            color: #eee;
        }

        .card-subtitle .fas.fa-star {
            color: #ffc107;
        }

        .card-subtitle .far.fa-star {
            color: #ccc;
        }

        span {
            font-size: 14px;
        }
    </style>
    <div id="container" class="container mt-4" data-has-variants="{{ $sanpham->co_bien_the == 1 ? 'true' :'false' }}" data-price="{{ $sanpham->gia }}" data-stock="{{ $sanpham->co_bien_the ? 0 : $sanpham->so_luong }}">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                @if (isset($sanpham->danhMuc) && $sanpham->danhMuc)
                    <li class="breadcrumb-item"><a
                            href="{{ route('danhmuc.show', $sanpham->danhMuc->id) }}">{{ $sanpham->danhMuc->ten }}</a></li>
                @else
                    <li class="breadcrumb-item">Danh mục</li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $sanpham->ten }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-4">
                <div class="main-img-box mb-3">
                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';" alt="Ảnh đại diện"
                        class="img-fluid rounded main-img current" id="main-image-1">
                    <img src="" alt="Ảnh phụ" class="img-fluid rounded main-img next" id="main-image-2"
                        style="display: none;">
                </div>
                <div class="thumb-list">
                    <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/default-thumbnail.png') }}';"
                        alt="Ảnh đại diện" class="img-thumb active">
                    @foreach ($sanpham->anhPhu as $anh)
                        <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-thumbnail.png') }}';"
                            alt="Ảnh phụ" class="img-thumb">
                    @endforeach
                </div>
            </div>

            <div class="col-md-8">
                <h4 class="fw-bold mb-3">{{ $sanpham->ten }}</h4>

                <h5>Thương hiệu: {{ $sanpham->thuongHieu->ten }}</h5>

                <div class="d-flex align-items-center mb-2">
                    <span class="me-3">Tình trạng: <span id="tinhtrang-span">
                        @php
                            if ($sanpham->co_bien_the) {
                                $allVariantsOut = $sanpham->bienTheSanPhams->count() > 0 && $sanpham->bienTheSanPhams->every(function($bt){ return $bt->ton_kho <= 0; });
                                $isOutOfStock = $allVariantsOut;
                            } else {
                                $isOutOfStock = $sanpham->so_luong <= 0;
                            }
                        @endphp
                        @if($isOutOfStock)
                            <span class="fw-bold text-warning">Hết hàng</span>
                        @else
                            <span class="fw-bold text-success">Còn hàng</span>
                        @endif
                    </span></span>
                </div>

                @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
                    <div class="flash-sale-info mb-3">
                        <span class="flash-sale-badge">
                            <i class="fas fa-bolt"></i> FLASH SALE
                        </span>
                        <div class="flash-sale-timer" id="flash-sale-timer">
                            Kết thúc sau: <span id="countdown-timer"></span>
                        </div>
                    </div>
                @endif

                <div class="d-md-flex gap-3">
                    <div class="flex-fill" style="min-width:0;">
                        @if ($sanpham->co_bien_the)
                        <form id="variant-selection-area" action="{{ route('client.cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="san_pham_id" value="{{ $sanpham->id }}">

                            <div class="mb-3">
                                <label class="form-label"><strong>Chọn cấu hình:</strong></label>
                                <div class="mb-2"><strong>RAM:</strong>
                                    <div id="ram-group" class="d-flex flex-wrap gap-2">
                                        @php
                                            $ramOptions = $sanpham->bienTheSanPhams
                                                ->pluck('ram.dung_luong')
                                                ->unique()
                                                ->filter();
                                        @endphp
                                        @foreach ($ramOptions as $ram)
                                            <button type="button" class="option-btn ram ram-btn btn"
                                                data-ram="{{ $ram }}">{{ $ram }}</button>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-2"><strong>SSD:</strong>
                                    <div id="ssd-group" class="d-flex flex-wrap gap-2">
                                        @php
                                            $ssdOptions = $sanpham->bienTheSanPhams
                                                ->pluck('oCung.dung_luong')
                                                ->unique()
                                                ->filter();
                                        @endphp
                                        @foreach ($ssdOptions as $ssd)
                                            <button type="button" class="option-btn ssd ssd-btn btn"
                                                data-ssd="{{ $ssd }}">{{ $ssd }}</button>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="bien_the_id" id="selected_variant" required>
                            </div>

                            <div id="bienthe-info" class="mb-3" style="display: none;">
                                <p><strong>Giá:</strong> <span id="bienthe-price" class="text-danger fw-bold"></span></p>
                                @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
                                    <p><strong>Giá FLASH SALE:</strong> <span id="bienthe-sale-price" class="text-danger fw-bold"></span></p>
                                @endif
                                <p><strong>Tồn kho:</strong> <span id="bienthe-stock" class="text-success fw-bold"></span></p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Số lượng:</strong></label>
                                <div class="input-group" style="max-width: 160px;">
                                    <button type="button" class="btn btn-outline-secondary" id="qty-minus">-</button>
                                    <input type="number" name="so_luong" id="so_luong" class="form-control text-center"
                                        value="1" min="1" style="max-width: 60px;" >
                                    <button type="button" class="btn btn-outline-secondary" id="qty-plus">+</button>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-2">
                                <button type="submit" class="btn btn-outline-danger btn-lg flex-fill" @if($isOutOfStock) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                    @if($isOutOfStock) HẾT HÀNG @else THÊM VÀO GIỎ @endif
                                </button>
                                <button type="button" class="btn btn-danger btn-lg flex-fill" id="buy-now-btn" @if($isOutOfStock) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                    @if($isOutOfStock) HẾT HÀNG @else MUA NGAY @endif
                                </button>
                            </div>
                        </form>
                        @else
                        <form action="{{ route('client.cart.add') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="san_pham_id" value="{{ $sanpham->id }}">
                            <div class="mb-3">
                                <label class="form-label"><strong>Giá:</strong></label>
                                <div class="current-price text-danger fw-bold" style="font-size: 1.5rem;">
                                    @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
                                        <span class="old-price">{{ number_format($sanpham->gia) }}₫</span><br>
                                        <span>{{ number_format($activeSaleEvent->gia_su_kien) }}₫</span>
                                    @else
                                        {{ number_format($sanpham->gia) }}₫
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <div id="bienthe-info" class="mb-3" style="display: none;">
                                    <p><strong>Giá:</strong> <span id="bienthe-price" class="text-danger fw-bold"></span></p>
                                    @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
                                        <p><strong>Giá FLASH SALE:</strong> <span id="bienthe-sale-price" class="text-danger fw-bold"></span></p>
                                        <p><strong>Số lượng FLASH SALE:</strong> <span id="bienthe-sale-stock" class="text-success fw-bold"></span></p>
                                    @endif
                                    <p><strong>Tồn kho:</strong> <span id="bienthe-stock" class="text-success fw-bold"></span></p>
                                </div>
                                @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
                                    <p><strong>Số lượng FLASH SALE:</strong> <span class="text-success fw-bold">{{ $activeSaleEvent->so_luong_gioi_han ?? $sanpham->so_luong }} sản phẩm</span></p>
                                @endif
                                {{-- @if ($activeSaleEvents->so_luong_gioi_han > 0) 
                                   <p><strong>Tồn kho:</strong> <span class="text-success fw-bold">{{ $activeSaleEvents->so_luong_gioi_han }} sản phẩm</span></p> 
                                @else
                                   <p><strong>Tồn kho:</strong> <span class="text-danger fw-bold">Hết hàng</span></p>
                                @endif --}}
                                    <p><strong>Tồn kho:</strong> <span class="text-success fw-bold">{{ $sanpham->so_luong }} sản phẩm</span></p> 
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><strong>Số lượng:</strong></label>
                                <div class="input-group" style="max-width: 160px;">
                                    <button type="button" class="btn btn-outline-secondary" id="qty-minus">-</button>
                                    <input type="number" name="so_luong" id="so_luong" class="form-control text-center" value="1" min="1" max="{{ $sanpham->so_luong }}" style="max-width: 60px;">
                                    <button type="button" class="btn btn-outline-secondary" id="qty-plus">+</button>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-2">
                                <button type="submit" class="btn btn-outline-danger btn-lg flex-fill" @if($isOutOfStock) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                    @if($isOutOfStock) HẾT HÀNG @else THÊM VÀO GIỎ @endif
                                </button>
                                <button type="button" class="btn btn-danger btn-lg flex-fill" id="buy-now-btn" @if($isOutOfStock) disabled style="background:#e9ecef;color:#888;cursor:not-allowed" @endif>
                                    @if($isOutOfStock) HẾT HÀNG @else MUA NGAY @endif
                                </button>
                            </div>
                        </form>
                        @endif
                        <form id="buy-now-form" action="{{ route('client.cart.buy-now') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="san_pham_id" value="{{ $sanpham->id }}">
                            <input type="hidden" name="bien_the_id" id="buy-now-bien-the-id">
                            <input type="hidden" name="so_luong" id="buy-now-so-luong">
                        </form>
                        <p class="mt-2 text-muted small">Giao tận nơi hoặc nhận tại cửa hàng</p>
                    </div>
                    <div style="min-width:220px;max-width:270px;">
                        <div class="bg-white border rounded p-3 mb-3">
                            <h6 class="fw-bold mb-3">Chính sách bán hàng</h6>
                            <div class="mb-2"><i class="fa fa-check-circle text-success me-2"></i>Cam kết 100% chính
                                hãng</div>
                            <div class="mb-2"><i class="fa fa-headset text-primary me-2"></i>Hỗ trợ 24/7</div>
                        </div>
                        <div class="bg-white border rounded p-3">
                            <h6 class="fw-bold mb-3">Thông tin thêm</h6>
                            <div class="mb-2"><i class="fa fa-shield-alt text-info me-2"></i>Hoàn tiền 111% nếu hàng giả
                            </div>
                            <div class="mb-2"><i class="fa fa-box-open text-warning me-2"></i>Mở hộp kiểm tra nhận hàng
                            </div>
                            <div class="mb-2"><i class="fa fa-sync-alt text-secondary me-2"></i>Đổi trả trong 7 ngày
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <hr>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="bg-light p-3 rounded mb-4 position-relative">
                    <h5 class="fw-bold">Thông tin sản phẩm</h5>
                    <div id="moTaSanPham" class="collapsed-mo-ta">{!! $sanpham->mo_ta !!}</div>
                    <div class="text-end mt-2">
                        <button class="btn btn-sm btn-outline-primary" id="btnToggleMoTa">Xem thêm</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-light p-3 rounded">
                    <h5 class="fw-bold">Cấu hình sản phẩm</h5>
                    <ul class="list-unstyled">
                        <li><strong>CPU:</strong> {{ $sanpham->chip->ten ?? 'Tùy chọn' }}</li>
                        <li><strong>Mainboard:</strong> {{ $sanpham->mainboard->ten ?? 'Tùy chọn' }}</li>
                        <li><strong>RAM:</strong> Tùy chọn</li>
                        <li><strong>SSD:</strong> Tùy chọn</li>
                        <li><strong>GPU:</strong> {{ $sanpham->gpu->ten ?? 'Tùy chọn' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-5">
            <div class="col-12">
                <h3>Đánh giá sản phẩm</h3>

                <div class="card mb-4">
                    <div class="card-header">
                        Gửi đánh giá của bạn
                    </div>
                    <div class="card-body">
                        @auth
                            <form action="{{ route('client.reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_product" value="{{ $sanpham->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Số sao:</label>
                                    <div id="rating-stars-input" class="rating-stars">
                                        <i class="far fa-star star-icon" data-value="1"></i>
                                        <i class="far fa-star star-icon" data-value="2"></i>
                                        <i class="far fa-star star-icon" data-value="3"></i>
                                        <i class="far fa-star star-icon" data-value="4"></i>
                                        <i class="far fa-star star-icon" data-value="5"></i>
                                    </div>
                                    <input type="hidden" name="so_sao" id="so_sao_input" value="{{ old('so_sao', 0) }}"
                                        class="@error('so_sao') is-invalid @enderror">
                                    @error('so_sao')
                                        <div class="invalid-feedback d-block">{{ $errors->first('so_sao') }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="binh_luan" class="form-label">Bình luận:</label>
                                    <textarea name="binh_luan" id="binh_luan" rows="4"
                                        class="form-control @error('binh_luan') is-invalid @enderror">{{ old('binh_luan') }}</textarea>
                                    @error('binh_luan')
                                        <div class="invalid-feedback">{{ $errors->first('binh_luan') }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>
                        @else
                            <p class="text-muted">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.</p>
                        @endauth
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Tất cả đánh giá ({{ $totalReviews }})</h6>
                @if ($sanpham->danhGiaSanPhams->count() > 0)
                    @foreach ($sanpham->danhGiaSanPhams as $danhGia)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $danhGia->user->ho_ten ?? 'Người dùng ẩn danh' }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    @for ($i = 0; $i < $danhGia->so_sao; $i++)
                                        <i class="fas fa-star text-warning"></i>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $danhGia->so_sao; $i++)
                                        <i class="far fa-star text-warning"></i>
                                    @endfor
                                    ({{ $danhGia->so_sao }} sao)
                                </h6>
                                <p class="card-text" id="review-content-{{ $danhGia->id }}">{{ $danhGia->binh_luan }}
                                </p>
                                <small class="text-muted">Đăng vào:
                                    {{ $danhGia->created_at->format('H:i d/m/Y') }}</small>

                                @auth
                                    @if (Auth::id() === $danhGia->id_user || Auth::user()->vai_tro === 'admin')
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-info edit-review-btn"
                                                data-review-id="{{ $danhGia->id }}" data-stars="{{ $danhGia->so_sao }}"
                                                data-comment="{{ $danhGia->binh_luan }}">Sửa</button>

                                            <form action="{{ route('client.reviews.destroy', $danhGia->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này không?');">Xóa</button>
                                            </form>
                                        </div>

                                        <div id="edit-form-{{ $danhGia->id }}" style="display: none;"
                                            class="mt-3 p-3 border rounded bg-light">
                                            <h6>Chỉnh sửa đánh giá của bạn</h6>
                                            <form action="{{ route('client.reviews.update', $danhGia->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <div class="mb-3">
                                                    <label class="form-label">Số sao:</label>
                                                    <div class="rating-stars" id="edit-stars-{{ $danhGia->id }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="far fa-star star-icon"
                                                                data-value="{{ $i }}"></i>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="so_sao"
                                                        id="edit-so_sao-{{ $danhGia->id }}" value="{{ $danhGia->so_sao }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-binh_luan-{{ $danhGia->id }}" class="form-label">Bình
                                                        luận:</label>
                                                    <textarea name="binh_luan" id="edit-binh_luan-{{ $danhGia->id }}" rows="3" class="form-control">{{ $danhGia->binh_luan }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-sm">Lưu</button>
                                                <button type="button" class="btn btn-secondary btn-sm cancel-edit-btn"
                                                    data-review-id="{{ $danhGia->id }}">Hủy</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Hãy là người đầu tiên đánh giá sản phẩm này!</p>
                @endif
            </div>
        </div>

        <hr>

        <div class="mt-5">
            <h5 class="fw-bold mb-3">Sản phẩm tương tự</h5>
            <div class="products-grid">
                @foreach ($sanphamTuongTu as $sp)
                    @php
                        if ($sp->co_bien_the) {
                            $bienThe = $sp->BienTheSanPhams->firstWhere(function ($bt) {
                                return (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                                       (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
                            }) ?? $sp->BienTheSanPhams->first();
                            $gia = $bienThe ? $bienThe->gia : 0;
                            $gia_so_sanh = $bienThe ? $bienThe->gia_so_sanh : null;
                            $saleEvent = $activeSaleEvents->firstWhere('bien_the_san_pham_id', $bienThe->id);
                            $gia_khuyen_mai = $saleEvent ? $saleEvent->gia_khuyen_mai : null;
                        } else {
                            $bienThe = null;
                            $gia = $sp->gia;
                            $gia_so_sanh = $sp->gia_so_sanh;
                            $saleEvent = $activeSaleEvents->firstWhere('san_pham_id', $sp->id);
                            $gia_khuyen_mai = $saleEvent ? $saleEvent->gia_khuyen_mai : null;
                        }
                    @endphp

                    <div class="product-card">
                        <div class="product-badges">
                            @if ($saleEvent && $saleEvent->suKien->ngay_ket_thuc >= now())
                                <span class="flash-sale-badge">
                                    <i class="fas fa-bolt"></i> FLASH SALE
                                </span>
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
                                @if ($gia_so_sanh && $gia_so_sanh > $gia)
                                    <div class="old-price">{{ number_format($gia_so_sanh) }}₫</div>
                                @endif
                                <div class="current-price-wrapper">
                                    <div class="current-price">
                                        @if ($gia_khuyen_mai && $gia_khuyen_mai < $gia)
                                            <span class="old-price">{{ number_format($gia) }}₫</span><br>
                                            {{ number_format($gia_khuyen_mai) }}₫
                                        @else
                                            {{ number_format($gia) }}₫
                                        @endif
                                    </div>
                                    @if ($gia_so_sanh && $gia_so_sanh > $gia)
                                        <div class="discount-badge">
                                            -{{ round((100 * ($gia_so_sanh - $gia)) / $gia_so_sanh) }}%
                                        </div>
                                    @elseif ($gia_khuyen_mai && $gia_khuyen_mai < $gia)
                                        <div class="discount-badge">
                                            -{{ round((100 * ($gia - $gia_khuyen_mai)) / $gia) }}%
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
                                <form action="{{ route('client.cart.add') }}" method="POST"
                                    class="add-to-cart-form"
                                    data-product-id="{{ $sp->id }}"
                                    data-variant-id="{{ $bienThe->id ?? '' }}">
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
                        <a href="{{ route('sanpham.show', $sp->id) }}?variant={{ $bienThe->id ?? '' }}" class="product-link"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // Lấy phần tử chứa data hasVariants
        const product = document.getElementById('container');
        const hasVariant = product.dataset.hasVariants === 'true';

        // Hàm hiển thị thông báo
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 3000);
        }

        // Countdown timer cho Flash Sale
        @if ($activeSaleEvent && $activeSaleEvent->suKien->ngay_ket_thuc >= now())
            function startCountdown(endTime) {
                const timerElement = document.getElementById('countdown-timer');
                if (!timerElement) return;

                function updateTimer() {
                    const now = new Date();
                    const end = new Date(endTime);
                    const diff = end - now;

                    if (diff <= 0) {
                        timerElement.textContent = 'Đã kết thúc';
                        return;
                    }

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                }

                updateTimer();
                setInterval(updateTimer, 1000);
            }

            document.addEventListener('DOMContentLoaded', function() {
                startCountdown('{{ $activeSaleEvent->suKien->ngay_ket_thuc }}');
            });
        @endif

        // Biến theo dõi trạng thái animation
        let isAnimating = false;
        let currentImageIndex = 1;

        document.querySelectorAll('.img-thumb').forEach(img => {
            img.addEventListener('click', function() {
                if (isAnimating) return;
                const newSrc = this.src;
                const currentImg = document.getElementById(`main-image-${currentImageIndex}`);
                const nextImg = document.getElementById(`main-image-${currentImageIndex === 1 ? 2 : 1}`);

                if (currentImg.src === newSrc) return;
                isAnimating = true;
                document.querySelectorAll('.img-thumb').forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                const preloadImg = new Image();
                preloadImg.onload = function() {
                    nextImg.src = newSrc;
                    nextImg.style.display = 'block';
                    nextImg.className = 'img-fluid rounded main-img next';

                    setTimeout(() => {
                        currentImg.classList.add('sliding');
                        nextImg.classList.remove('next');
                        nextImg.classList.add('current');

                        setTimeout(() => {
                            currentImg.style.display = 'none';
                            currentImg.classList.remove('sliding', 'current');
                            currentImg.classList.add('next');
                            currentImageIndex = currentImageIndex === 1 ? 2 : 1;
                            isAnimating = false;
                        }, 600);
                    }, 10);
                };
                preloadImg.src = newSrc;
            });
        });

        // Thiết lập ảnh đầu tiên khi load trang
        document.addEventListener('DOMContentLoaded', function() {
            const mainImg1 = document.getElementById('main-image-1');
            mainImg1.classList.add('current');
        });

        // Xử lý nút "Xem thêm" cho mô tả sản phẩm
        document.getElementById('btnToggleMoTa').addEventListener('click', function() {
            const moTa = document.getElementById('moTaSanPham');
            const isCollapsed = moTa.classList.contains('collapsed-mo-ta');

            if (isCollapsed) {
                moTa.classList.remove('collapsed-mo-ta');
                moTa.classList.add('expanded-mo-ta');
                this.textContent = 'Thu gọn';
            } else {
                moTa.classList.remove('expanded-mo-ta');
                moTa.classList.add('collapsed-mo-ta');
                this.textContent = 'Xem thêm';
            }
        });

        // Danh sách biến thể lưu trong JS (mảng các object)
        const bienThes = [
            @foreach ($sanpham->bienTheSanPhams as $bienThe)
                {
                    id: '{{ $bienThe->id }}',
                    ram: '{{ $bienThe->ram->dung_luong ?? '' }}',
                    ssd: '{{ $bienThe->oCung->dung_luong ?? '' }}',
                    price: parseFloat('{{ $bienThe->gia ?? 0 }}'),
                    salePrice: parseFloat('@php
                        $saleEvent = $activeSaleEvents->firstWhere('bien_the_san_pham_id', $bienThe->id);
                        echo $saleEvent ? $saleEvent->gia_khuyen_mai : $bienThe->gia;
                    @endphp' ?? 0),
                    stock: parseInt('{{ $bienThe->ton_kho ?? 0 }}')
        }@if (!$loop->last),@endif
            @endforeach
        ];

        let selectedRam = null;
        let selectedSsd = null;

        if (hasVariant) {
            // Nếu có biến thể, hiển thị phần chọn biến thể, gán sự kiện
            document.querySelectorAll('.ram-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.ram-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedRam = this.dataset.ram;
                    updateVariantInfo();
                });
            });
            document.querySelectorAll('.ssd-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.ssd-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedSsd = this.dataset.ssd;
                    updateVariantInfo();
                });
            });

            function updateVariantInfo() {
                    if (selectedRam && selectedSsd) {
                        const variant = bienThes.find(v => v.ram === selectedRam && v.ssd === selectedSsd);
                        if (variant) {
                            document.getElementById('selected_variant').value = variant.id;
                            document.getElementById('bienthe-info').style.display = 'block';
                            document.getElementById('bienthe-price').textContent = parseInt(variant.price).toLocaleString('vi-VN') + 'đ';
                            const salePriceElement = document.getElementById('bienthe-sale-price');
                            if (salePriceElement && variant.salePrice < variant.price) {
                                salePriceElement.textContent = parseInt(variant.salePrice).toLocaleString('vi-VN') + 'đ';
                                salePriceElement.parentElement.style.display = 'block';
                            } else {
                                if (salePriceElement) salePriceElement.parentElement.style.display = 'none';
                            }
                            // Thêm số lượng Flash Sale (giả sử lấy từ salePrice hoặc dữ liệu khác)
                            const saleStockElement = document.getElementById('bienthe-sale-stock');
                            if (saleStockElement && variant.salePrice > 0) {
                                // Giả sử số lượng Flash Sale được lấy từ một trường mới hoặc logic backend
                                saleStockElement.textContent = variant.stock + ' sản phẩm'; // Thay bằng dữ liệu thực tế nếu có
                                saleStockElement.parentElement.style.display = 'block';
                            } else {
                                if (saleStockElement) saleStockElement.parentElement.style.display = 'none';
                            }
                            document.getElementById('bienthe-stock').textContent = variant.stock + ' sản phẩm';

                            // Disable nút nếu hết hàng
                            const addBtn = document.querySelector('.btn-outline-danger');
                            const buyBtn = document.getElementById('buy-now-btn');
                            if (parseInt(variant.stock) <= 0) {
                                addBtn.disabled = true;
                                addBtn.textContent = 'HẾT HÀNG';
                                addBtn.style.background = '#e9ecef';
                                addBtn.style.color = '#888';
                                addBtn.style.cursor = 'not-allowed';
                                buyBtn.disabled = true;
                                buyBtn.textContent = 'HẾT HÀNG';
                                buyBtn.style.background = '#e9ecef';
                                buyBtn.style.color = '#888';
                                buyBtn.style.cursor = 'not-allowed';
                                document.getElementById('tinhtrang-span').innerHTML = '<span class="fw-bold text-warning">Hết hàng</span>';
                            } else {
                                addBtn.disabled = false;
                                addBtn.textContent = 'THÊM VÀO GIỎ';
                                addBtn.style.background = '';
                                addBtn.style.color = '';
                                addBtn.style.cursor = '';
                                buyBtn.disabled = false;
                                buyBtn.textContent = 'MUA NGAY';
                                buyBtn.style.background = '';
                                buyBtn.style.color = '';
                                buyBtn.style.cursor = '';
                                document.getElementById('tinhtrang-span').innerHTML = '<span class="fw-bold text-success">Còn hàng</span>';
                            }
                        } else {
                            document.getElementById('selected_variant').value = '';
                            document.getElementById('bienthe-info').style.display = 'none';
                        }
                    } else {
                        document.getElementById('selected_variant').value = '';
                        document.getElementById('bienthe-info').style.display = 'none';
                    }
                }
            } else {
                // Không có biến thể: giá và tồn kho đã được hiển thị tĩnh trong Blade
                const productStock = product.dataset.stock;

                // Disable nút nếu hết hàng
                const addBtn = document.querySelector('.btn-outline-danger');
                const buyBtn = document.getElementById('buy-now-btn');
                if (parseInt(productStock) <= 0) {
                    addBtn.disabled = true;
                    addBtn.textContent = 'HẾT HÀNG';
                    addBtn.style.background = '#e9ecef';
                    addBtn.style.color = '#888';
                    addBtn.style.cursor = 'not-allowed';
                    buyBtn.disabled = true;
                    buyBtn.textContent = 'HẾT HÀNG';
                    buyBtn.style.background = '#e9ecef';
                    buyBtn.style.color = '#888';
                    buyBtn.style.cursor = 'not-allowed';
                    document.getElementById('tinhtrang-span').innerHTML = '<span class="fw-bold text-warning">Hết hàng</span>';
                } else {
                    addBtn.disabled = false;
                    addBtn.textContent = 'THÊM VÀO GIỎ';
                    addBtn.style.background = '';
                    addBtn.style.color = '';
                    addBtn.style.cursor = '';
                    buyBtn.disabled = false;
                    buyBtn.textContent = 'MUA NGAY';
                    buyBtn.style.background = '';
                    buyBtn.style.color = '';
                    buyBtn.style.cursor = '';
                    document.getElementById('tinhtrang-span').innerHTML = '<span class="fw-bold text-success">Còn hàng</span>';
                }
            }

        // Tăng giảm số lượng với kiểm tra tồn kho
        document.getElementById('qty-minus').onclick = function() {
            var qty = document.getElementById('so_luong');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        };

        document.getElementById('qty-plus').onclick = function() {
            var qty = document.getElementById('so_luong');
            const selectedVariantId = document.getElementById('selected_variant')?.value;

            if (hasVariant) {
                if (selectedVariantId) {
                    const variant = bienThes.find(v => v.id === selectedVariantId);
                    if (variant) {
                        const maxStock = parseInt(variant.stock);
                        if (parseInt(qty.value) < maxStock) {
                            qty.value = parseInt(qty.value) + 1;
                        } else {
                            console.log(`Số lượng không được vượt quá ${maxStock} sản phẩm`);
                        }
                    }
                } else {
                    showToast('Vui lòng chọn cấu hình sản phẩm trước!', 'error');
                }
            } else {
                const maxStock = parseInt(product.dataset.stock);
                if (parseInt(qty.value) < maxStock) {
                    qty.value = parseInt(qty.value) + 1;
                } else {
                    console.log(`Số lượng không được vượt quá ${maxStock} sản phẩm`);
                }
            }
        };

        document.getElementById('so_luong').addEventListener('input', function() {
            const selectedVariantId = document.getElementById('selected_variant')?.value;
            let maxStock = 0;

            if (hasVariant) {
                if (selectedVariantId) {
                    const variant = bienThes.find(v => v.id === selectedVariantId);
                    if (variant) {
                        maxStock = parseInt(variant.stock);
                    }
                } else {
                    this.value = 1;
                    showToast('Vui lòng chọn cấu hình sản phẩm trước!', 'error');
                    return;
                }
            } else {
                maxStock = parseInt(product.dataset.stock);
            }

            let currentQty = parseInt(this.value);
            if (isNaN(currentQty) || currentQty < 1) {
                this.value = 1;
                showToast('Số lượng tối thiểu là 1!', 'error');
            } else if (currentQty > maxStock) {
                this.value = maxStock;
                console.log(`Số lượng không được vượt quá ${maxStock} sản phẩm`);
            }
        });

        // Xử lý nút MUA NGAY
        document.getElementById('buy-now-btn').addEventListener('click', function() {
            let selectedVariant = '';
            if (hasVariant) {
                selectedVariant = document.getElementById('selected_variant')?.value;
            }
            const soLuong = parseInt(document.getElementById('so_luong').value);

            if (hasVariant && !selectedVariant) {
                showToast('Vui lòng chọn cấu hình sản phẩm trước khi mua!', 'error');
                return;
            }

            let maxStock = 0;
            if (hasVariant) {
                const variant = bienThes.find(v => v.id === selectedVariant);
                if (variant) {
                    maxStock = parseInt(variant.stock);
                }
            } else {
                maxStock = parseInt(product.dataset.stock);
            }

            if (soLuong > maxStock) {
                console.log(`Số lượng không được vượt quá ${maxStock} sản phẩm!`);
                return;
            }

            document.getElementById('buy-now-bien-the-id').value = selectedVariant;
            document.getElementById('buy-now-so-luong').value = soLuong;

            const button = this;
            const originalText = button.textContent;
            button.disabled = true;
            button.textContent = 'Đang xử lý...';

            const form = document.getElementById('buy-now-form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount && data.cart_count) {
                        cartCount.textContent = data.cart_count;
                    }
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.href = '{{ route("client.cart.index") }}';
                    }
                } else {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        showToast(data.message || 'Có lỗi xảy ra khi mua sản phẩm!', 'error');
                        button.disabled = false;
                        button.textContent = originalText;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Có lỗi xảy ra khi mua sản phẩm!', 'error');
                button.disabled = false;
                button.textContent = originalText;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const newReviewStarsContainer = document.getElementById('rating-stars-input');
            if (newReviewStarsContainer) {
                const newReviewHiddenInput = document.getElementById('so_sao_input');
                const newReviewStars = newReviewStarsContainer.querySelectorAll('.star-icon');

                newReviewStars.forEach((star, index) => {
                    star.addEventListener('click', () => {
                        const rating = index + 1;
                        newReviewHiddenInput.value = rating;
                        updateStars(newReviewStars, rating);
                    });
                    star.addEventListener('mouseover', () => {
                        highlightStars(newReviewStars, index + 1);
                    });
                    star.addEventListener('mouseout', () => {
                        const currentRating = newReviewHiddenInput.value ? parseInt(
                            newReviewHiddenInput.value) : 0;
                        updateStars(newReviewStars, currentRating);
                    });
                });
                const initialRating = newReviewHiddenInput.value ? parseInt(newReviewHiddenInput.value) : 0;
                updateStars(newReviewStars, initialRating);
            }

            const urlParams = new URLSearchParams(window.location.search);
            const variantId = urlParams.get('variant');

            if (variantId) {
                const targetVariant = bienThes.find(v => v.id === variantId);
                if (targetVariant) {
                    selectedRam = targetVariant.ram;
                    selectedSsd = targetVariant.ssd;

                    document.querySelectorAll('.ram-btn').forEach(btn => {
                        if (btn.dataset.ram === selectedRam) {
                            btn.classList.add('active');
                        } else {
                            btn.classList.remove('active');
                        }
                    });

                    document.querySelectorAll('.ssd-btn').forEach(btn => {
                        if (btn.dataset.ssd === selectedSsd) {
                            btn.classList.add('active');
                        } else {
                            btn.classList.remove('active');
                        }
                    });

                    updateVariantInfo();
                }
            }

            document.querySelectorAll('.edit-review-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.dataset.reviewId;
                    const currentStars = this.dataset.stars;
                    const currentComment = this.dataset.comment;

                    const editForm = document.getElementById(`edit-form-${reviewId}`);
                    const commentTextarea = document.getElementById(`edit-binh_luan-${reviewId}`);
                    const soSaoInput = document.getElementById(`edit-so_sao-${reviewId}`);
                    const editStarsContainer = document.getElementById(`edit-stars-${reviewId}`);
                    const editStars = editStarsContainer.querySelectorAll('.star-icon');

                    document.getElementById(`review-content-${reviewId}`).style.display = 'none';
                    editForm.style.display = 'block';

                    commentTextarea.value = currentComment;
                    soSaoInput.value = currentStars;

                    updateStars(editStars, parseInt(currentStars));

                    editStars.forEach((star, index) => {
                        star.onclick = () => {
                            const rating = index + 1;
                            soSaoInput.value = rating;
                            updateStars(editStars, rating);
                        };
                        star.onmouseover = () => {
                            highlightStars(editStars, index + 1);
                        };
                        star.onmouseout = () => {
                            const currentRating = soSaoInput.value ? parseInt(soSaoInput
                                .value) : 0;
                            updateStars(editStars, currentRating);
                        };
                    });
                });
            });

            document.querySelectorAll('.cancel-edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.dataset.reviewId;
                    document.getElementById(`edit-form-${reviewId}`).style.display = 'none';
                    document.getElementById(`review-content-${reviewId}`).style.display = 'block';
                });
            });

            function updateStars(starsArray, rating) {
                starsArray.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('fas');
                        star.classList.remove('far');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }

            function highlightStars(starsArray, rating) {
                starsArray.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('fas');
                        star.classList.remove('far');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }

            // Xử lý form thêm vào giỏ cho sản phẩm tương tự
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const button = this.querySelector('.add-to-cart-btn');
                    const originalContent = button.innerHTML;
                    const variantId = this.querySelector('input[name="bien_the_id"]').value;
                    const qty = parseInt(this.querySelector('input[name="so_luong"]').value);

                    const variant = bienThes.find(v => v.id === variantId);
                    if (variant && qty > parseInt(variant.stock)) {
                        console.log(`Số lượng không được vượt quá ${variant.stock} sản phẩm!`);
                        return;
                    }

                    button.className = 'add-to-cart-btn loading';
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Đang thêm...</span>';

                    const formData = new FormData(this);

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const cartCount = document.querySelector('.cart-count');
                            if (cartCount && data.cart_count) {
                                cartCount.textContent = data.cart_count;
                            }
                            button.className = 'add-to-cart-btn success';
                            button.innerHTML = '<i class="fas fa-check"></i> <span>Đã thêm!</span>';
                            showToast(data.message || 'Đã thêm sản phẩm vào giỏ hàng!', 'success');
                        } else {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                throw new Error(data.message || 'Có lỗi xảy ra từ máy chủ');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
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
                });
            });
        });

        document.getElementById('btnToggleMoTa').addEventListener('click', function() {
            const moTa = document.getElementById('moTaSanPham');
            const btn = this;

            if (moTa.classList.contains('collapsed-mo-ta')) {
                moTa.classList.remove('collapsed-mo-ta');
                moTa.classList.add('expanded-mo-ta');
                btn.textContent = 'Thu gọn';
            } else {
                moTa.classList.remove('expanded-mo-ta');
                moTa.classList.add('collapsed-mo-ta');
                btn.textContent = 'Xem thêm';
            }
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection