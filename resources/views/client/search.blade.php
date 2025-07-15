@extends('client.layouts.app')
@section('content')
    @include('client.layouts.blocks.banner')
    <div class="container py-4">
        <div class="filter-area mb-4">
            <form method="GET" action="{{ route('searcher.search') }}" class="filter-form d-flex align-items-center flex-wrap">
                <div class="input-group me-3 mb-2">
                    <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ $keyword }}">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>

                {{-- Thêm các bộ lọc khác ở đây --}}
                @isset($rams) {{-- Kiểm tra xem biến $rams có tồn tại không trước khi hiển thị --}}
                <div class="me-3 mb-2">
                    <label for="id_ram" class="form-label visually-hidden">RAM:</label>
                    <select name="id_ram" id="id_ram" class="form-select" onchange="this.form.submit()">
                        <option value="">Tất cả RAM</option>
                        @foreach($rams as $ram)
                            <option value="{{ $ram->id }}" {{ request('id_ram') == $ram->id ? 'selected' : '' }}>{{ $ram->ten_ram }}</option>
                        @endforeach
                    </select>
                </div>
                @endisset

                @isset($o_cungs) {{-- Kiểm tra xem biến $o_cungs có tồn tại không trước khi hiển thị --}}
                <div class="me-3 mb-2">
                    <label for="id_o_cung" class="form-label visually-hidden">Ổ cứng:</label>
                    <select name="id_o_cung" id="id_o_cung" class="form-select" onchange="this.form.submit()">
                        <option value="">Tất cả ổ cứng</option>
                        @foreach($o_cungs as $oc)
                            <option value="{{ $oc->id }}" {{ request('id_o_cung') == $oc->id ? 'selected' : '' }}>{{ $oc->ten_o_cung }}</option>
                        @endforeach
                    </select>
                </div>
                @endisset
                
                <button type="button" class="btn btn-outline-secondary mb-2" onclick="resetSearchFilters()">
                    <i class="fas fa-redo-alt"></i> Xóa bộ lọc
                </button>
            </form>
        </div>

        @if ($sanphams->isEmpty())
            <p>Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $keyword }}".</p>
        @else
            {{--
                LƯU Ý: Mã gốc có bộ lọc where('id_category', $danhMuc->id) ở đây.
            --}}
            <div class="products-slider-wrapper">
                <button type="button" class="slider-btn left" onclick="scrollProducts(this, -1)"><i
                        class="fas fa-chevron-left"></i></button>
                <div class="products-slider">
                    {{-- Lặp qua TẤT CẢ $sanphams vì chúng đã được lọc bởi controller --}}
                    @foreach ($sanphams as $sp) 
                        @php
                            $bienThe = $sp->bienTheSanPhams->first() ?? $sp->BienTheSanPhams()->first(); // Sử dụng first() từ collection, fallback để truy vấn nếu cần (mặc dù eager loading sẽ bao gồm điều này)
                            
                            if ($sp->co_bien_the) {
                                $gia = $bienThe ? $bienThe->gia : 0;
                                $gia_so_sanh = $bienThe ? $bienThe->gia_so_sanh : null;
                            } else {
                                $gia = $sp->gia;
                                $gia_so_sanh = $sp->gia_so_sanh;
                            }
                        @endphp

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
                                        data-variant-id="{{ $bienThe->id ?? '' }}"> {{-- Bây giờ nó sẽ đúng --}}
                                        @csrf
                                        <input type="hidden" name="san_pham_id" value="{{ $sp->id }}">
                                        <input type="hidden" name="bien_the_id" value="{{ $bienThe->id ?? '' }}"> {{-- Bây giờ nó sẽ đúng --}}
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
                <button type="button" class="slider-btn right" onclick="scrollProducts(this, 1)"><i
                        class="fas fa-chevron-right"></i></button>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $sanphams->appends(request()->except('page'))->links() }}
            </div>
        @endif
    </div>

    <script>
        function resetSearchFilters() {
            const url = new URL(window.location.href);
            // Xóa tất cả các tham số lọc trừ 'keyword'
            url.searchParams.forEach((value, key) => {
                if (key !== 'keyword' && key !== 'page') { // Giữ 'keyword' và loại bỏ 'page'
                    url.searchParams.delete(key);
                }
            });
            url.searchParams.set('keyword', ''); // Xóa luôn từ khóa khi reset
            window.location.href = url.toString();
        }
    </script>
@endsection