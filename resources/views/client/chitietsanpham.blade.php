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

        /* Trong file CSS của bạn */

        .rating-stars {
            font-size: 1.5rem;
            /* Kích thước ngôi sao */
            color: #ccc;
            /* Màu mặc định của ngôi sao rỗng */
            cursor: pointer;
            display: inline-block;
            /* Để các ngôi sao nằm cùng hàng */
        }

        .rating-stars .star {
            color: #ffd700;
            /* Màu vàng cho ngôi sao đã chọn */
            transition: color 0.2s;
        }

        .rating-stars .star:hover,
        .rating-stars .star.selected {
            color: #ffc107;
            /* Màu sáng hơn khi rê chuột hoặc đã chọn */
        }

        /* Thêm vào nếu muốn hover đẹp hơn */
        .rating-stars .star:hover~.star:not(.selected) {
            color: #eee;
        }

        /* Cho các ngôi sao hiển thị trên phần danh sách đánh giá */
        .card-subtitle .fas.fa-star {
            color: #ffc107;
            /* Màu vàng cho sao đã được đánh giá */
        }

        .card-subtitle .far.fa-star {
            color: #ccc;
            /* Màu xám cho sao rỗng trong hiển thị */
        }
        /* Giới hạn nội dung mô tả sản phẩm không tràn ra ngoài */
        .product-description-content {
            max-width: 100%;
            overflow-x: auto;
            word-break: break-word;
        }
        .product-description-content img,
        .product-description-content video {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 16px auto;
        }
        .product-description-content table {
            max-width: 100%;
            width: 100% !important;
            display: block;
            overflow-x: auto;
        }
    </style>
    <div class="container mt-4">
        {{-- Phần thông báo thành công/lỗi --}}
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

                {{-- HIỂN THỊ ĐÁNH GIÁ TRUNG BÌNH VÀ TỔNG SỐ ĐÁNH GIÁ --}}
                <div class="d-flex align-items-center mb-3">
                    <span class="fs-5 text-warning me-2">
                        @php
                            $fullStars = floor($averageRating);
                            $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - $fullStars - $halfStar;
                        @endphp
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @if ($halfStar)
                            <i class="fas fa-star-half-alt"></i>
                        @endif
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    </span>
                    <span class="fs-5 fw-bold me-2">{{ number_format($averageRating, 1) }}</span>
                    <span class="text-muted">({{ $totalReviews }} đánh giá)</span>
                </div>
                {{-- HẾT PHẦN ĐÁNH GIÁ TRUNG BÌNH --}}

                <div class="d-md-flex gap-3">
                    <div class="flex-fill" style="min-width:0;">
                        <form action="{{ route('client.cart.add') }}" method="POST" class="mt-4">
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
                                <p><strong>Tồn kho:</strong> <span id="bienthe-stock" class="text-success fw-bold"></span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Số lượng:</strong></label>
                                <div class="input-group" style="max-width: 160px;">
                                    <button type="button" class="btn btn-outline-secondary" id="qty-minus">-</button>
                                    <input type="number" name="so_luong" id="so_luong" class="form-control text-center"
                                        value="1" min="1" style="max-width: 60px;">
                                    <button type="button" class="btn btn-outline-secondary" id="qty-plus">+</button>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-2">
                                <button type="submit" class="btn btn-outline-danger btn-lg flex-fill">THÊM VÀO GIỎ</button>
                                <button type="submit" class="btn btn-danger btn-lg flex-fill">MUA NGAY</button>
                            </div>
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
        </div>

        <hr> {{-- Thêm đường kẻ ngang để tách các phần --}}

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="bg-light p-3 rounded mb-4">
                    <h5 class="fw-bold">Thông tin sản phẩm</h5>
                    <div class="product-description-content">{!! $sanpham->mo_ta !!}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-light p-3 rounded">
                    <h5 class="fw-bold">Cấu hình sản phẩm</h5>
                    <ul class="list-unstyled">
                        <li><strong>CPU:</strong> {{ $sanpham->chip->ten ?? 'Không có' }}</li>
                        <li><strong>Mainboard:</strong> {{ $sanpham->mainboard->ten ?? 'Không có' }}</li>
                        {{-- Dưới đây là các phần bạn cần điều chỉnh nếu RAM/SSD/GPU được quản lý qua biến thể thay vì trực tiếp từ sản phẩm --}}
                        <li><strong>RAM:</strong> {{ $sanpham->ram->dung_luong ?? 'Không có' }}</li>
                        <li><strong>SSD:</strong> {{ $sanpham->ssd->dung_luong ?? 'Không có' }}</li>
                        <li><strong>GPU:</strong> {{ $sanpham->gpu->ten ?? 'Không có' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        {{-- PHẦN ĐÁNH GIÁ SẢN PHẨM MỚI TÍCH HỢP --}}
        <div class="row mt-5">
            <div class="col-12">
                <h3>Đánh giá sản phẩm</h3>

                {{-- Form Gửi Đánh giá --}}
                <div class="card mb-4">
                    <div class="card-header">
                        Gửi đánh giá của bạn
                    </div>
                    <div class="card-body">
                        @auth {{-- Chỉ hiển thị form nếu người dùng đã đăng nhập --}}
                            <form action="{{ route('client.reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_product" value="{{ $sanpham->id }}">

                                <div class="mb-3">
                                    <label class="form-label">Số sao:</label>
                                    <div id="rating-stars-input" class="rating-stars">
                                        {{-- Các ngôi sao tương tác, sẽ được JS xử lý để thêm class fas/far --}}
                                        <i class="far fa-star star-icon" data-value="1"></i>
                                        <i class="far fa-star star-icon" data-value="2"></i>
                                        <i class="far fa-star star-icon" data-value="3"></i>
                                        <i class="far fa-star star-icon" data-value="4"></i>
                                        <i class="far fa-star star-icon" data-value="5"></i>
                                    </div>
                                    {{-- Input ẩn để gửi giá trị số sao thực tế --}}
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

                {{-- HIỂN THỊ DANH SÁCH CÁC ĐÁNH GIÁ ĐÃ DUYỆT --}}
                <h6 class="fw-bold mb-3">Tất cả đánh giá ({{ $totalReviews }})</h6>
                @if ($sanpham->danhGiaSanPhams->count() > 0)
                    @foreach ($sanpham->danhGiaSanPhams as $danhGia)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $danhGia->user->ho_ten ?? 'Người dùng ẩn danh' }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{-- Hiển thị các ngôi sao đánh giá --}}
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

                                {{-- Nút Sửa/Xóa (chỉ hiển thị nếu là chủ sở hữu hoặc admin) --}}
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

                                        {{-- Form sửa ẩn (sẽ hiển thị khi click nút Sửa bởi JavaScript) --}}
                                        <div id="edit-form-{{ $danhGia->id }}" style="display: none;"
                                            class="mt-3 p-3 border rounded bg-light">
                                            <h6>Chỉnh sửa đánh giá của bạn</h6>
                                            <form action="{{ route('client.reviews.update', $danhGia->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH') {{-- Sử dụng PATCH cho cập nhật --}}

                                                <div class="mb-3">
                                                    <label class="form-label">Số sao:</label>
                                                    <div class="rating-stars" id="edit-stars-{{ $danhGia->id }}">
                                                        {{-- Các ngôi sao tương tác cho form sửa, sẽ được JS xử lý --}}
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
        {{-- KẾT THÚC PHẦN ĐÁNH GIÁ SẢN PHẨM MỚI --}}

        <hr>

        <div class="mt-5">
            <h5 class="fw-bold mb-3">Sản phẩm tương tự</h5>
            <div class="products-grid">
                @foreach ($sanphamTuongTu as $sp)
                    @php
                        $bienThe = $sp->bienTheSanPhams->first(); // Lấy biến thể đầu tiên để hiển thị giá
                        $discountPercent = 0;
                        if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia) {
                            $discountPercent = round(
                                (100 * ($bienThe->gia_so_sanh - $bienThe->gia)) / $bienThe->gia_so_sanh,
                            );
                        }
                    @endphp
                    <div class="product-card position-relative">
                        <div class="product-badges">
                            @if ($sp->is_hot)
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
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="rating-text">({{ rand(3, 15) }})</span>
                            </div>
                            <div class="product-actions">
                                <form action="" method="POST" class="add-to-cart-form d-inline-block"
                                    onsubmit="addToCart(event, {{ $sp->id }}, {{ $bienThe->id ?? 'null' }})">
                                    @csrf
                                    <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                                    <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}">
                                    <input type="hidden" name="so_luong" value="1">
                                    <button type="submit" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Thêm vào giỏ</span>
                                    </button>
                                </form>
                                <a href="{{ route('sanpham.show', $sp->id) }}"
                                    class="product-detail-btn d-inline-block"> {{-- Đảm bảo route đúng --}}
                                    <i class="fas fa-info-circle"></i>
                                    <span>Chi tiết</span>
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('sanpham.show', $sp->id) }}" class="product-link" tabindex="-1"></a>
                        {{-- Đảm bảo route đúng --}}
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
            img.addEventListener('click', function() {
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
                    document.getElementById('bienthe-price').textContent = parseInt(variant.price).toLocaleString('vi-VN') +
                        'đ';
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


        document.addEventListener('DOMContentLoaded', function() {
            // Logic cho form Gửi Đánh giá mới (từ ví dụ trước)
            const newReviewStarsContainer = document.getElementById('rating-stars-input');
            if (newReviewStarsContainer) { // Kiểm tra nếu phần tử tồn tại
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

            // Logic cho form SỬA Đánh giá
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

                    // Ẩn nội dung bình luận và hiện form sửa
                    document.getElementById(`review-content-${reviewId}`).style.display = 'none';
                    editForm.style.display = 'block';

                    // Đổ dữ liệu cũ vào form sửa
                    commentTextarea.value = currentComment;
                    soSaoInput.value = currentStars;

                    // Cập nhật trạng thái sao trên form sửa
                    updateStars(editStars, parseInt(currentStars));

                    // Thêm listeners cho sao trên form sửa
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

            // Logic cho nút Hủy sửa
            document.querySelectorAll('.cancel-edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reviewId = this.dataset.reviewId;
                    document.getElementById(`edit-form-${reviewId}`).style.display = 'none';
                    document.getElementById(`review-content-${reviewId}`).style.display = 'block';
                });
            });

            // Hàm chung để cập nhật/highlight sao
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
        });
    </script>

    <!-- FontAwesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection
