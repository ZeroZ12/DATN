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
</style>
<div class="container mt-4">
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
                    <form action="{{ route('giohang.them')}}" method="POST" class="mt-4">
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
                            <button type="submit" class="btn btn-outline-danger btn-lg flex-fill">THÊM VÀO GIỎ</button>
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
        <div class="d-flex overflow-auto gap-3">
            @foreach ($sanphamTuongTu as $sp)
                <div class="card" style="min-width: 200px;">
                    <img src="{{ asset('storage/' . $sp->anh_dai_dien) }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                         class="card-img-top"
                         style="height: 150px; object-fit: cover;"
                         alt="{{ $sp->ten }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $sp->ten }}</h6>
                        <p class="text-danger fw-bold mb-2">
                            {{ number_format($sp->gia_khuyen_mai ?? $sp->gia, 0, ',', '.') }}đ
                        </p>
                        <a href="{{ route('sanpham.show', $sp->id) }}" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
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
