@extends('client.layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Chi tiết sản phẩm -->
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <div class="border rounded p-2 mb-3 bg-white text-center" style="height: 400px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}"
                     onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';"
                     alt="Ảnh đại diện"
                     class="img-fluid rounded main-img"
                     style="max-height: 100%; max-width: 100%; object-fit: contain; transition: opacity 0.3s ease;">
            </div>

            <div class="d-flex gap-2 flex-wrap justify-content-start">
                @foreach ($sanpham->anhPhu as $anh)
                    <img src="{{ asset('storage/' . $anh->duong_dan) }}"
                         onerror="this.onerror=null;this.src='{{ asset('images/default-thumbnail.png') }}';"
                         alt="Ảnh phụ"
                         class="img-thumbnail img-preview"
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                @endforeach
            </div>
        </div>

        <!-- Thông tin & chọn biến thể -->
        <div class="col-md-6">
            <h4 class="fw-bold mb-3">{{ $sanpham->ten }}</h4>

            <!-- Form chọn biến thể -->
            <form action="#" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="id_san_pham" value="{{ $sanpham->id }}">

                <div class="mb-3">
                    <label for="bienthe" class="form-label"><strong>Chọn cấu hình:</strong></label>
                    <select name="id_bien_the" id="bienthe" class="form-select" required onchange="updateBienTheInfo()">
                        <option value="">-- Vui lòng chọn --</option>
                        @foreach ($sanpham->bienTheSanPhams as $bienThe)
                            <option value="{{ $bienThe->id }}"
                                    data-price="{{ $bienThe->gia }}"
                                    data-stock="{{ $bienThe->ton_kho }}"
                                    data-ram="{{ $bienThe->ram->dung_luong ?? 'Không có' }}"
                                    data-ssd="{{ $bienThe->oCung->dung_luong ?? 'Không có' }}">
                                {{ $bienThe->ma_bien_the }} - RAM: {{ $bienThe->ram->dung_luong ?? 'Không có' }}, SSD: {{ $bienThe->oCung->dung_luong ?? 'Không có' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Hiển thị thông tin biến thể -->
                <div id="bienthe-info" class="mb-3" style="display: none;">
                    <p><strong>Giá:</strong> <span id="bienthe-price" class="text-danger fw-bold"></span></p>
                    <p><strong>Tồn kho:</strong> <span id="bienthe-stock" class="text-success fw-bold"></span></p>
                </div>

                <button type="submit" class="btn btn-danger btn-lg w-100">MUA NGAY</button>
            </form>

            <p class="mt-2 text-muted small">Giao tận nơi hoặc nhận tại cửa hàng</p>
        </div>
    </div>

    <!-- Mô tả và cấu hình -->
    <div class="row mt-5">
        <div class="col-md-8">
            <div class="bg-light p-3 rounded mb-4">
                <h5 class="fw-bold">Thông tin sản phẩm</h5>
                <div>{!! nl2br(e($sanpham->mo_ta)) !!}</div>
            </div>

            <!-- Đánh giá -->
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
    document.querySelectorAll('.img-preview').forEach(img => {
        img.addEventListener('click', function () {
            const mainImg = document.querySelector('.main-img');
            const newImg = new Image();
            newImg.src = this.src;
            mainImg.style.opacity = 0;
            newImg.onload = function () {
                mainImg.src = newImg.src;
                mainImg.style.opacity = 1;
            };
        });
    });

    function updateBienTheInfo() {
        const select = document.getElementById('bienthe');
        const selectedOption = select.options[select.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const stock = selectedOption.getAttribute('data-stock');

        if (price && stock) {
            document.getElementById('bienthe-info').style.display = 'block';
            document.getElementById('bienthe-price').textContent = parseInt(price).toLocaleString('vi-VN') + 'đ';
            document.getElementById('bienthe-stock').textContent = stock + ' sản phẩm';
        } else {
            document.getElementById('bienthe-info').style.display = 'none';
        }
    }
</script>
@endsection
