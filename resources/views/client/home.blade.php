@extends('client.layouts.app');

@section('content')
 <!-- Bộ lọc -->
<div class="container py-3">
  <form method="GET" action="{{ route('client.home') }}">
    <div class="d-flex flex-wrap justify-content-center gap-2">

      <select name="id_brand" class="form-select form-select-sm w-auto">
        <option value="">-- Thương hiệu --</option>
        @foreach($thuongHieus as $item)
          <option value="{{ $item->id }}" {{ request('id_brand') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
        @endforeach
      </select>

      <select name="id_chip" class="form-select form-select-sm w-auto">
        <option value="">-- CPU --</option>
        @foreach($chips as $item)
          <option value="{{ $item->id }}" {{ request('id_chip') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
        @endforeach
      </select>

      <select name="id_gpu" class="form-select form-select-sm w-auto">
        <option value="">-- GPU --</option>
        @foreach($gpus as $item)
          <option value="{{ $item->id }}" {{ request('id_gpu') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
        @endforeach
      </select>

      <select name="id_ram" class="form-select form-select-sm w-auto">
        <option value="">-- RAM --</option>
        @foreach($rams as $item)
          <option value="{{ $item->id }}" {{ request('id_ram') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}</option>
        @endforeach
      </select>

      <select name="id_o_cung" class="form-select form-select-sm w-auto">
        <option value="">-- Ổ cứng --</option>
        @foreach($oCungs as $item)
          <option value="{{ $item->id }}" {{ request('id_o_cung') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}</option>
        @endforeach
      </select>

      <button type="submit" class="btn btn-sm btn-primary">Lọc</button>
      <a href="{{ route('client.home') }}" class="btn btn-sm btn-outline-secondary">Đặt lại</a>
    </div>
  </form>
</div>


 <!-- Danh sách sản phẩm -->
<div class="container py-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($sanphams as $sp)
      @php
        // Ưu tiên biến thể phù hợp với filter (RAM và ổ cứng), fallback về biến thể đầu tiên nếu không có
        $bienThe = $sp->BienTheSanPham->firstWhere(function ($bt) {
            return
                (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
                (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
        }) ?? $sp->BienTheSanPham->first();
      @endphp

      <div class="col">
        <a href="{{ $sp->ma_san_pham }}" class="text-decoration-none text-dark">
          <div class="card h-100 shadow-sm border-0 product-card">
            <div class="position-relative">
              <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
                   class="card-img-top rounded-top"
                   alt="{{ $sp->ten }}">
              @if ($sp->is_hot)
                <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1">
                  <i class="fa-solid fa-gift me-1"></i> Quà tặng HOT
                </span>
              @endif
            </div>

            <div class="card-body d-flex flex-column">
              <!-- Tên sản phẩm -->
              <h6 class="card-title fw-semibold product-name mb-2">
                {{ \Illuminate\Support\Str::limit($sp->ten, 50) }}
              </h6>

              <!-- Cấu hình rút gọn -->
              <div class="bg-light rounded px-2 py-2 mb-2 small">
                @if ($sp->chip)
                  <div><i class="fa-solid fa-microchip me-1"></i> {{ $sp->chip->ten }}</div>
                @endif

                @if ($sp->gpu)
                  <div><i class="fa-solid fa-video me-1"></i> {{ $sp->gpu->ten }}</div>
                @endif

                @if ($bienThe?->ram)
                  <div><i class="fa-solid fa-memory me-1"></i> {{ $bienThe->ram->dung_luong }} GB</div>
                @endif

                @if ($bienThe?->oCung)
                  <div><i class="fa-solid fa-hdd me-1"></i> Ổ cứng: {{ $bienThe->oCung->dung_luong }} ({{ $bienThe->oCung->loai }})</div>
                @endif
              </div>

              <!-- Giá và giảm giá -->
              <div class="mb-2 mt-auto">
                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                  <span class="text-muted text-decoration-line-through small">
                    {{ number_format($bienThe->gia_so_sanh) }}₫
                  </span>
                @endif
                <span class="text-danger fw-bold fs-6 ms-2">
                  {{ number_format($bienThe->gia ?? 0) }}₫
                </span>

                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                  <span class="badge bg-danger ms-2">
                    -{{ round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh) }}%
                  </span>
                @endif
              </div>

              <!-- Đánh giá -->
              <div class="small text-muted">
                <i class="fa-solid fa-star text-warning me-1"></i>
                0.0 <span class="ms-1">(0 đánh giá)</span>
              </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <!-- Phân trang -->
  <div class="mt-4">
    {{ $sanphams->links() }}
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
