@extends('client.layouts.app');

@section('content')
 <!-- Bộ lọc -->
  <div class="container filter-bar my-3 d-flex flex-wrap gap-2">
    <button class="btn btn-outline-secondary text-black btn-sm"><i class="fa fa-filter me-1"></i> Bộ lọc</button>
    <button class="btn btn-outline-secondary text-black btn-sm">Tình trạng sản phẩm</button>
    <button class="btn btn-outline-secondary text-black btn-sm">Giá</button>
    <button class="btn btn-outline-secondary text-black btn-sm">Hãng</button>
    <button class="btn btn-outline-secondary text-black btn-sm">CPU</button>
    <button class="btn btn-outline-secondary text-black btn-sm">RAM</button>
    <button class="btn btn-outline-secondary text-black btn-sm">SSD</button>
    <button class="btn btn-outline-secondary text-black btn-sm">VGA</button>
  </div>

  <!-- Danh sách sản phẩm -->
<div class="container py-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($sanphams as $sp)
      @php
        $bienThe = $sp->BienTheSanPham->first(); // Lấy biến thể đầu tiên
      @endphp

      <div class="col">
        <a href="{{ $sp->ma_san_pham }}" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0 product-card">
            <div class="position-relative">
              <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
                   class="card-img-top rounded-top"
                   alt="{{ $sp->ten }}">

              @if ($sp->is_hot ?? false)
                <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1">
                  <i class="fa-solid fa-gift me-1"></i> Quà tặng HOT
                </span>
              @endif
            </div>

            <div class="card-body d-flex flex-column">
              <h6 class="card-title fw-semibold product-name mb-2">{{ $sp->ten }}</h6>

              <div class="mb-2 mt-auto">
                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                  <span class="text-muted text-decoration-line-through small">
                    {{ number_format($bienThe->gia_so_sanh) }}₫
                  </span>
                @endif

                <span class="text-danger fw-bold ms-2">
                  {{ number_format($bienThe->gia ?? 0) }}₫
                </span>

                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                  <span class="ms-2 text-success small">
                    -{{ round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh) }}%
                  </span>
                @endif
              </div>

              <div class="small text-muted">
                <span class="rating">★★★★☆</span> ({{ $sp->so_danh_gia ?? 5 }})
              </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>

@endsection

@push('css')
<style>
  .product-name {
    height: 3em; /* Tối đa 2 dòng */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .product-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 0.75rem;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  .card-img-top {
    height: 180px;
    object-fit: cover;
  }
</style>


@endpush
