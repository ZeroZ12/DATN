@extends('client.layouts.app')

@section('content')
  <!-- Bộ lọc -->
  <div class="container py-3">
    <form method="GET" action="{{ route('client.home') }}">
    <div class="d-flex flex-wrap justify-content-center gap-2">

      <select name="id_brand" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- Thương hiệu --</option>
      @foreach($thuongHieus as $item)
      <option value="{{ $item->id }}" {{ request('id_brand') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
    @endforeach
      </select>

      <select name="id_chip" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- CPU --</option>
      @foreach($chips as $item)
      <option value="{{ $item->id }}" {{ request('id_chip') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
    @endforeach
      </select>

      <select name="id_gpu" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- GPU --</option>
      @foreach($gpus as $item)
      <option value="{{ $item->id }}" {{ request('id_gpu') == $item->id ? 'selected' : '' }}>{{ $item->ten }}</option>
    @endforeach
      </select>

      <select name="id_ram" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- RAM --</option>
      @foreach($rams as $item)
      <option value="{{ $item->id }}" {{ request('id_ram') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}
      </option>
    @endforeach
      </select>

      <select name="id_o_cung" class="form-select form-select-sm" style="width: 200px;">
      <option value="">-- Ổ cứng --</option>
      @foreach($oCungs as $item)
      <option value="{{ $item->id }}" {{ request('id_o_cung') == $item->id ? 'selected' : '' }}>{{ $item->dung_luong }}
      </option>
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
      $bienThe = $sp->BienTheSanPhams->firstWhere(function ($bt) {
      return
      (!request('id_ram') || $bt->id_ram == request('id_ram')) &&
      (!request('id_o_cung') || $bt->id_o_cung == request('id_o_cung'));
      }) ?? $sp->BienTheSanPhams->first();
    @endphp

    <div class="col">
    <a href="{{ route('sanpham.show', $sp->id) }}" class="text-decoration-none text-dark">

      <div
      class="card h-100 shadow-lg border-0 product-card position-relative overflow-hidden rounded-4 transition-all"
      style="transition: box-shadow 0.3s;">
      <div class="position-relative">
      <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
        class="card-img-top rounded-top-4 object-fit-cover" alt="{{ $sp->ten }}"
        style="height: 220px; object-fit: cover;">
      @if ($sp->is_hot)
      <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-3 py-2 fs-7 shadow">
      <i class="fa-solid fa-fire me-1"></i> HOT
      </span>
      @endif
      @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
      <span class="badge bg-success position-absolute top-0 end-0 m-2 px-3 py-2 fs-7 shadow">
      -{{ round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh) }}%
      </span>
      @endif
      </div>

      <div class="card-body d-flex flex-column">
      <h6 class="card-title fw-bold product-name mb-2 text-truncate" title="{{ $sp->ten }}">
        {{ \Illuminate\Support\Str::limit($sp->ten, 50) }}
      </h6>

      <div class="bg-light rounded-3 px-2 py-2 mb-2 small border">
        @if ($sp->chip)
      <div><i class="fa-solid fa-microchip me-1 text-primary"></i> {{ $sp->chip->ten }}</div>
      @endif
        @if ($sp->gpu)
      <div><i class="fa-solid fa-video me-1 text-success"></i> {{ $sp->gpu->ten }}</div>
      @endif
        @if ($bienThe?->ram)
      <div><i class="fa-solid fa-memory me-1 text-info"></i> {{ $bienThe->ram->dung_luong }} GB RAM</div>
      @endif
        @if ($bienThe?->oCung)
      <div><i class="fa-solid fa-hdd me-1 text-secondary"></i> {{ $bienThe->oCung->dung_luong }}
      {{ $bienThe->oCung->loai }}</div>
      @endif
      </div>

      <div class="mb-2 mt-200px">
        @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
      <span class="text-muted text-decoration-line-through small">
      {{ number_format($bienThe->gia_so_sanh) }}₫
      </span>
      @endif
        <span class="text-danger fw-bold fs-5 ms-2">
        {{ number_format($bienThe->gia ?? 0) }}₫
        </span>
      </div>

      <div class="small text-muted d-flex align-items-center">
        <i class="fa-solid fa-star text-warning me-1"></i>
        <span>0.0</span>
        <span class="ms-1">(0 đánh giá)</span>
      </div>
      </div>
      </div>
      </a>
    </div>

    <style>
      .product-card:hover {
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18), 0 1.5px 6px rgba(0, 0, 0, 0.08);
      transform: translateY(-4px) scale(1.02);
      transition: all 0.3s;
      }

      .product-name {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      }
    </style>
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
    height: 3em;
    /* Tối đa 2 dòng */
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
