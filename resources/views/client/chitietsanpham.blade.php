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
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
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
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
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
    .img-thumb.active, .img-thumb:hover {
        border: 2.5px solid #dc3545;
        box-shadow: 0 2px 8px rgba(220,53,69,0.10);
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
        box-shadow: 0 6px 24px rgba(220,53,69,0.12), 0 1.5px 6px rgba(0,0,0,0.04);
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
</style>
<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
            @if(isset($sanpham->danhMuc) && $sanpham->danhMuc)
                <li class="breadcrumb-item"><a href="{{ route('danhmuc.index', $sanpham->danhMuc->id) }}">{{ $sanpham->danhMuc->ten }}</a></li>
            @else
                <li class="breadcrumb-item">Danh mục</li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $sanpham->ten }}</li>
        </ol>
    </nav>
    <!-- Chi tiết sản phẩm -->
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-4">
            <div class="main-img-box mb-3">
                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                     onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                     alt="Ảnh đại diện"
                     class="img-fluid rounded main-img current"
                     id="main-image-1">
                <img src=""
                     alt="Ảnh phụ"
                     class="img-fluid rounded main-img next"
                     id="main-image-2"
                     style="display: none;">
            </div>
            <div class="thumb-list">
                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                     onerror="this.onerror=null;this.src='{{ asset('images/default-thumbnail.png') }}';"
                     alt="Ảnh đại diện"
                     class="img-thumb active">
                @foreach ($sanpham->anhPhu as $anh)
                    <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/default-thumbnail.png') }}';"
                         alt="Ảnh phụ"
                         class="img-thumb">
                @endforeach
            </div>
        </div>

        <!-- Thông tin & chọn biến thể + số lượng + nút + box chính sách song song -->
        <div class="col-md-8">
            <h4 class="fw-bold mb-3">{{ $sanpham->ten }}</h4>
            <div class="d-md-flex gap-3">
                <div class="flex-fill" style="min-width:0;">
                    <form action="#" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="id_san_pham" value="{{ $sanpham->id }}">

                        <div class="mb-3">
                            <label class="form-label"><strong>Chọn cấu hình:</strong></label>
                            <div class="mb-2"><strong>RAM:</strong>
                                <div id="ram-group" class="d-flex flex-wrap gap-2">
                                    @php
                                        $ramOptions = $sanpham->bienTheSanPhams->pluck('ram.dung_luong')->unique()->filter();
                                    @endphp
                                    @foreach ($ramOptions as $ram)
                                        <button type="button" class="option-btn ram ram-btn btn" data-ram="{{ $ram }}">{{ $ram }}</button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-2"><strong>SSD:</strong>
                                <div id="ssd-group" class="d-flex flex-wrap gap-2">
                                    @php
                                        $ssdOptions = $sanpham->bienTheSanPhams->pluck('oCung.dung_luong')->unique()->filter();
                                    @endphp
                                    @foreach ($ssdOptions as $ssd)
                                        <button type="button" class="option-btn ssd ssd-btn btn" data-ssd="{{ $ssd }}">{{ $ssd }}</button>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="id_bien_the" id="selected_variant" required>
                        </div>

                        <div id="bienthe-info" class="mb-3" style="display: none;">
                            <p><strong>Giá:</strong> <span id="bienthe-price" class="text-danger fw-bold"></span></p>
                            <p><strong>Tồn kho:</strong> <span id="bienthe-stock" class="text-success fw-bold"></span></p>
                        </div>

                        <!-- Số lượng -->
                        <div class="mb-3">
                            <label class="form-label"><strong>Số lượng:</strong></label>
                            <div class="input-group" style="max-width: 160px;">
                                <button type="button" class="btn btn-outline-secondary" id="qty-minus">-</button>
                                <input type="number" name="so_luong" id="so_luong" class="form-control text-center" value="1" min="1" style="max-width: 60px;">
                                <button type="button" class="btn btn-outline-secondary" id="qty-plus">+</button>
                            </div>
                        </div>

                        <!-- Nút -->
                        <div class="d-flex gap-2 mb-2">
                            <button type="button" class="btn btn-outline-danger btn-lg flex-fill" id="add-to-cart"><i class="fa fa-shopping-cart me-2"></i>THÊM VÀO GIỎ</button>
                            <button type="submit" class="btn btn-danger btn-lg flex-fill">MUA NGAY</button>
                        </div>
                    </form>
                    <p class="mt-2 text-muted small">Giao tận nơi hoặc nhận tại cửa hàng</p>
                </div>
                <div style="min-width:220px;max-width:270px;">
                    <div class="bg-white border rounded p-3 mb-3">
                        <h6 class="fw-bold mb-3">Chính sách bán hàng</h6>
                        <div class="mb-2"><i class="fa fa-check-circle text-success me-2"></i>Cam kết 100% chính hãng</div>
                        <div class="mb-2"><i class="fa fa-headset text-primary me-2"></i>Hỗ trợ 24/7</div>
                    </div>
                    <div class="bg-white border rounded p-3">
                        <h6 class="fw-bold mb-3">Thông tin thêm</h6>
                        <div class="mb-2"><i class="fa fa-shield-alt text-info me-2"></i>Hoàn tiền 111% nếu hàng giả</div>
                        <div class="mb-2"><i class="fa fa-box-open text-warning me-2"></i>Mở hộp kiểm tra nhận hàng</div>
                        <div class="mb-2"><i class="fa fa-sync-alt text-secondary me-2"></i>Đổi trả trong 7 ngày</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mô tả và cấu hình -->
    <div class="row mt-5">
        <div class="col-md-8">
            <div class="bg-light p-3 rounded mb-4">
                <h5 class="fw-bold">Thông tin sản phẩm</h5>
                <div>{!! nl2br(e($sanpham->mo_ta)) !!}</div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold">Đánh giá & Nhận xét</h5>
                <p class="text-muted">Chưa có đánh giá</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-light p-3 rounded">
                <h5 class="fw-bold">Cấu hình sản phẩm</h5>
                <ul class="list-unstyled">
                    <li><strong>CPU:</strong> {{ $sanpham->chip->ten ?? 'Không có' }}</li>
                    <li><strong>Mainboard:</strong> {{ $sanpham->mainboard->ten ?? 'Không có' }}</li>
                    <li><strong>RAM:</strong> {{ $sanpham->ram->dung_luong ?? 'Không có' }}</li>
                    <li><strong>SSD:</strong> {{ $sanpham->ssd->dung_luong ?? 'Không có' }}</li>
                    <li><strong>GPU:</strong> {{ $sanpham->gpu->ten ?? 'Không có' }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sản phẩm tương tự -->
    <div class="mt-5">
        <h5 class="fw-bold mb-3">Sản phẩm tương tự</h5>
        <div class="products-grid">
            @foreach ($sanphamTuongTu as $sp)
                @php
                    $bienThe = $sp->BienTheSanPhams->first();
                    $discountPercent = 0;
                    if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia) {
                        $discountPercent = round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh);
                    }
                @endphp
                <div class="product-card position-relative">
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
                                -{{ $discountPercent }}%
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
                            <form action="" method="POST" class="add-to-cart-form d-inline-block" onsubmit="addToCart(event, {{ $sp->id }}, {{ $bienThe->id ?? 'null' }})">
                                @csrf
                                <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                                <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}">
                                <input type="hidden" name="so_luong" value="1">
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Thêm vào giỏ</span>
                                </button>
                            </form>
                            <a href="{{ route('sanpham.show', $sp->id) }}" class="product-detail-btn d-inline-block">
                                <i class="fas fa-info-circle"></i>
                                <span>Chi tiết</span>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('sanpham.show', $sp->id) }}" class="product-link" tabindex="-1"></a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- JS đổi ảnh chính & cập nhật biến thể -->
<script>
    // Biến theo dõi trạng thái animation
    let isAnimating = false;
    let currentImageIndex = 1; // 1 hoặc 2

    // Đổi ảnh chính với hiệu ứng trượt liền mạch
    document.querySelectorAll('.img-thumb').forEach(img => {
        img.addEventListener('click', function () {
            // Ngăn spam click khi animation đang chạy
            if (isAnimating) return;

            const newSrc = this.src;
            const currentImg = document.getElementById(`main-image-${currentImageIndex}`);
            const nextImg = document.getElementById(`main-image-${currentImageIndex === 1 ? 2 : 1}`);

            // Nếu ảnh đã được chọn thì không làm gì
            if (currentImg.src === newSrc) return;

            // Đặt flag animation
            isAnimating = true;

            // Cập nhật active state cho thumbnail
            document.querySelectorAll('.img-thumb').forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            // Preload ảnh mới vào ảnh tiếp theo
            const preloadImg = new Image();
            preloadImg.onload = function() {
                // Đặt ảnh mới vào ảnh tiếp theo và hiển thị
                nextImg.src = newSrc;
                nextImg.style.display = 'block';
                nextImg.className = 'img-fluid rounded main-img next';

                // Chờ một chút để đảm bảo ảnh đã render
                setTimeout(() => {
                    // Bắt đầu animation: ảnh hiện tại trượt ra trái, ảnh mới trượt vào
                    currentImg.classList.add('sliding');
                    nextImg.classList.remove('next');
                    nextImg.classList.add('current');

                    // Sau khi animation hoàn thành
                    setTimeout(() => {
                        // Ẩn ảnh cũ và reset class
                        currentImg.style.display = 'none';
                        currentImg.classList.remove('sliding', 'current');
                        currentImg.classList.add('next');

                        // Chuyển đổi index
                        currentImageIndex = currentImageIndex === 1 ? 2 : 1;

                        // Reset animation flag
                        isAnimating = false;
                    }, 600); // Khớp với thời gian transition
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

    // Lưu danh sách biến thể vào JS
    const bienThes = [
        @foreach ($sanpham->bienTheSanPhams as $bienThe)
            {
                id: '{{ $bienThe->id }}',
                ram: '{{ $bienThe->ram->dung_luong ?? '' }}',
                ssd: '{{ $bienThe->oCung->dung_luong ?? '' }}',
                price: '{{ $bienThe->gia }}',
                stock: '{{ $bienThe->ton_kho }}'
            },
        @endforeach
    ];

    let selectedRam = null;
    let selectedSsd = null;

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
                document.getElementById('bienthe-stock').textContent = variant.stock + ' sản phẩm';
            } else {
                document.getElementById('selected_variant').value = '';
                document.getElementById('bienthe-info').style.display = 'none';
            }
        } else {
            document.getElementById('selected_variant').value = '';
            document.getElementById('bienthe-info').style.display = 'none';
        }
    }

    // Tăng giảm số lượng
    document.getElementById('qty-minus').onclick = function() {
        var qty = document.getElementById('so_luong');
        if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
    };
    document.getElementById('qty-plus').onclick = function() {
        var qty = document.getElementById('so_luong');
        qty.value = parseInt(qty.value) + 1;
    };
</script>

<!-- FontAwesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
@endsection
