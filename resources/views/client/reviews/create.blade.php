@extends('client.layouts.app')

@section('title', 'Đánh giá sản phẩm')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Đánh giá sản phẩm</h4>

    <!-- Hiển thị thông báo lỗi từ session -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-xmark me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-3">
                <img src="{{ asset('storage/' . $sanPham->anh_dai_dien) }}"
                     alt="Ảnh sản phẩm" width="100" class="me-3 rounded border">
                <div>
                    <h5 class="mb-1">{{ $sanPham->ten }}</h5>
                    <p class="text-muted small">Thương hiệu: {{ $sanPham->thuongHieu->ten ?? '---' }}</p>
                </div>
            </div>

            <form action="{{ route('client.reviews.store') }}" method="POST" id="reviewForm">
                @csrf
                <input type="hidden" name="id_product" value="{{ $sanPham->id }}">
                <input type="hidden" name="so_sao" id="starRatingInput" value="0">

                <div class="mb-3">
                    <label class="form-label">Chọn số sao:</label>
                    <div class="star-rating" id="starRating" role="radiogroup" aria-label="Chọn số sao">
                        <button type="button" class="star" data-value="1" aria-label="1 sao">☆</button>
                        <button type="button" class="star" data-value="2" aria-label="2 sao">☆</button>
                        <button type="button" class="star" data-value="3" aria-label="3 sao">☆</button>
                        <button type="button" class="star" data-value="4" aria-label="4 sao">☆</button>
                        <button type="button" class="star" data-value="5" aria-label="5 sao">☆</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nhận xét:</label>
                    <textarea name="binh_luan" rows="3" class="form-control" placeholder="Viết cảm nhận của bạn..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary" onclick="return validateReview()">Gửi đánh giá</button>
                <a href="{{ route('client.orders.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .star-rating {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            display: inline-flex;
            gap: 0.2rem;
        }

        .star {
            transition: color 0.2s ease;
            background: transparent;
            border: none;
            padding: 0 4px;
            line-height: 1;
            cursor: pointer;
        }

        .star:hover,
        .star.active {
            color: #ffd700; /* Màu vàng cho ngôi sao được chọn */
        }

        .alert-custom {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            display: none;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const starRatingInput = document.getElementById('starRatingInput');

            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const value = this.getAttribute('data-value');
                    highlightStars(value);
                });

                star.addEventListener('mouseout', function() {
                    const currentValue = starRatingInput.value || 0;
                    highlightStars(currentValue);
                });

                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    starRatingInput.value = value;
                    highlightStars(value);
                });
            });

            function highlightStars(value) {
                stars.forEach(star => {
                    const starValue = star.getAttribute('data-value');
                    if (starValue <= value) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }
        });

        function validateReview() {
            const value = parseInt(document.getElementById('starRatingInput').value || '0');
            if (value < 1 || value > 5) {
                alert('Vui lòng chọn số sao từ 1 đến 5.');
                return false;
            }
            return true;
        }
    </script>
@endpush
