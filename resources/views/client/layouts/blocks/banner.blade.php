<!-- Dynamic Banner (Carousel) -->
<div class="banner-wrapper">
    <div class="container">
        <div class="row">


            <!-- Slider -->
            <div class="col-9">
                <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @if(isset($banners) && $banners->count() > 0)
                            @foreach ($banners as $banner)
                                @if ($banner->image_url)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $banner->image_url) }}" class="d-block w-100" alt="{{ $banner->title }}">
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/images/banner/default-banner.jpg') }}" class="d-block w-100" alt="Default Banner">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Banner bên phải -->
            <div class="col-3">
                <div class="side-banners">
                  @if (isset($r_cates) && $r_cates->count() > 0)
                    @foreach ($r_cates as $r_cate)
                        <a href="{{ route('danhmuc.index', $r_cate->id) }}" class="side-banner">
                            <img src="{{ asset('storage/' . $r_cate->hinh_anh) }}" class="img-fluid" style="max-width: 100%;height: auto;">
                        </a>
                    @endforeach
                  @else
                    <span class="text-muted">Chưa có danh mục bên phải</span>
                  @endif
                </div>
            </div>
        </div>

        <!-- 4 Banner phía dưới -->
        <div class="row mt-4">
          @if (isset($b_cates) && $b_cates->count() > 0)
            @foreach ($b_cates as $b_cate)
                <div class="col-3 mb-3">
                    <div class="bottom-banner">
                        <a href="{{ route('danhmuc.index', $b_cate->id) }}">
                            <img src="{{ asset('storage/' . $b_cate->hinh_anh) }}" class="img-fluid" style="width: 100%; height: 138px; object-fit: cover;">
                        </a>
                    </div>
                </div>
            @endforeach
          @else
            <div class="col-12">
                <span class="text-muted">Chưa có banner phía dưới</span>
            </div>
              
          @endif
        </div>
    </div>
</div>

<style>
.banner-wrapper {
    padding: 20px 0;
    background: #f8f9fa;
}

.side-banners {
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 100%;
}

.side-banner img {
    width: 100%;
    height: calc(33.33% - 7px);
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.side-banner:hover img {
    transform: scale(1.05);
}

.bottom-banner img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.bottom-banner:hover img {
    transform: scale(1.05);
}

.carousel-inner {
    border-radius: 8px;
    overflow: hidden;
}
</style>
