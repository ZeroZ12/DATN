  <!-- Dynamic Banner (Carousel) -->
  <div class="container d-flex justify-content-center">
    <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade mt-3 w-100" data-bs-ride="carousel" data-bs-interval="3000">
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
          @else
              <span>Không có ảnh</span>
          @endif
          @endforeach
        @else
          <!-- Default banner or placeholder when no banners are available -->
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
  <style>
    .slide{
      width: 86%;
    }
  </style>
