@extends('client.layouts.app')
@section('content')
    @include('client.layouts.blocks.banner')
    <div class="container py-4">
        <!-- Categories Section -->
    <div class="filter-area mb-4">
            <form method="GET" action="{{ route('searcher.search') }}" class="filter-form">
                <input type="hidden" name="keyword" value="{{ $keyword }}"> {{-- Giữ lại từ khóa tìm kiếm ban đầu --}}
                <div class="d-flex flex-wrap gap-2"> {{-- Sử dụng flexbox cho các select box --}}
                    <select name="id_brand" class="form-select filter-tab-select">
                        <option value="">Hãng</option>
                        @foreach ($thuongHieus as $item)
                            <option value="{{ $item->id }}" {{ request('id_brand') == $item->id ? 'selected' : '' }}>
                                {{ $item->ten }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_chip" class="form-select filter-tab-select">
                        <option value="">CPU</option>
                        @foreach ($chips as $item)
                            <option value="{{ $item->id }}" {{ request('id_chip') == $item->id ? 'selected' : '' }}>
                                {{ $item->ten }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_ram" class="form-select filter-tab-select">
                        <option value="">RAM</option>
                        @foreach ($rams as $item)
                            <option value="{{ $item->id }}" {{ request('id_ram') == $item->id ? 'selected' : '' }}>
                                {{ $item->dung_luong }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_o_cung" class="form-select filter-tab-select">
                        <option value="">SSD</option>
                        @foreach ($oCungs as $item)
                            <option value="{{ $item->id }}" {{ request('id_o_cung') == $item->id ? 'selected' : '' }}>
                                {{ $item->dung_luong }}
                            </option>
                        @endforeach
                    </select>

                    <select name="id_gpu" class="form-select filter-tab-select">
                        <option value="">VGA</option>
                        @foreach ($gpus as $item)
                            <option value="{{ $item->id }}" {{ request('id_gpu') == $item->id ? 'selected' : '' }}>
                                {{ $item->ten }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary filter-submit-btn">
                        <i class="fas fa-search"></i> Lọc
                    </button>

                    <button type="button" class="btn btn-secondary filter-reset-btn" onclick="resetSearchFilters()">
                        <i class="fas fa-times"></i> Xóa bộ lọc
                    </button>
                </div>
            </form>
        </div>


        @if ($searchResults->isEmpty())
            <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $keyword }}".</p>
        @else
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($searchResults as $sp)
                    @php
                        if ($sp->co_bien_the) {
                            $bienThe = $sp->BienTheSanPhams->firstWhere(function ($bt) use ($request) {
                                return (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                                       (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
                            }) ?? $sp->BienTheSanPhams->first(); // fallback if specific variant not found
                            $gia = $bienThe ? $bienThe->gia : 0;
                            $gia_so_sanh = $bienThe ? $bienThe->gia_so_sanh : null;
                        } else {
                            $bienThe = null;
                            $gia = $sp->gia;
                            $gia_so_sanh = $sp->gia_so_sanh;
                        }
                    @endphp
                    {{-- Product Card (Tái sử dụng code từ trang chủ) --}}
                    <div class="col">
                        <div class="product-card">
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
                    </div>
                @endforeach
            </div>
            {{-- Thêm phân trang nếu bạn dùng $searchResults->links() --}}
            <div class="d-flex justify-content-center mt-4">
                {{-- {{ $searchResults->links() }} --}}
            </div>
        @endif
    </div>

    <script>
        function resetSearchFilters() {
            // Lấy URL hiện tại
            const url = new URL(window.location.href);

            // Xóa tất cả các tham số lọc trừ 'keyword'
            url.searchParams.forEach((value, key) => {
                if (key !== 'keyword') {
                    url.searchParams.delete(key);
                }
            });

            // Chuyển hướng đến URL mới
            window.location.href = url.toString();
        }
    </script>
@endsection

