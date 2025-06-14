@extends('client.layouts.app')

@section('content')
  <!-- Bộ lọc với dropdown -->
  <div class="container py-3">
    <form method="GET" action="{{ route('client.home') }}">
      <div class="filter-bar my-3 d-flex flex-wrap gap-2">

        <!-- Filter Thương hiệu -->
        <details class="filter-group">
          <summary class="btn btn-outline-secondary text-black btn-sm">Thương hiệu</summary>
          <div class="filter-content p-3 bg-white shadow-sm">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_brand" id="brand_all" value="" {{ !request('id_brand') ? 'checked' : '' }}>
              <label class="form-check-label" for="brand_all">Tất cả</label>
            </div>
            @foreach($thuongHieus as $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_brand" id="brand_{{ $item->id }}" value="{{ $item->id }}" {{ request('id_brand') == $item->id ? 'checked' : '' }}>
              <label class="form-check-label" for="brand_{{ $item->id }}">{{ $item->ten }}</label>
            </div>
            @endforeach
          </div>
        </details>

        <!-- Filter CPU -->
        <details class="filter-group">
          <summary class="btn btn-outline-secondary text-black btn-sm">CPU</summary>
          <div class="filter-content p-3 bg-white shadow-sm">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_chip" id="chip_all" value="" {{ !request('id_chip') ? 'checked' : '' }}>
              <label class="form-check-label" for="chip_all">Tất cả</label>
            </div>
            @foreach($chips as $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_chip" id="chip_{{ $item->id }}" value="{{ $item->id }}" {{ request('id_chip') == $item->id ? 'checked' : '' }}>
              <label class="form-check-label" for="chip_{{ $item->id }}">{{ $item->ten }}</label>
            </div>
            @endforeach
          </div>
        </details>

        <!-- Filter GPU -->
        <details class="filter-group">
          <summary class="btn btn-outline-secondary text-black btn-sm">GPU</summary>
          <div class="filter-content p-3 bg-white shadow-sm">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_gpu" id="gpu_all" value="" {{ !request('id_gpu') ? 'checked' : '' }}>
              <label class="form-check-label" for="gpu_all">Tất cả</label>
            </div>
            @foreach($gpus as $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_gpu" id="gpu_{{ $item->id }}" value="{{ $item->id }}" {{ request('id_gpu') == $item->id ? 'checked' : '' }}>
              <label class="form-check-label" for="gpu_{{ $item->id }}">{{ $item->ten }}</label>
            </div>
            @endforeach
          </div>
        </details>

        <!-- Filter RAM -->
        <details class="filter-group">
          <summary class="btn btn-outline-secondary text-black btn-sm">RAM</summary>
          <div class="filter-content p-3 bg-white shadow-sm">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_ram" id="ram_all" value="" {{ !request('id_ram') ? 'checked' : '' }}>
              <label class="form-check-label" for="ram_all">Tất cả</label>
            </div>
            @foreach($rams as $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_ram" id="ram_{{ $item->id }}" value="{{ $item->id }}" {{ request('id_ram') == $item->id ? 'checked' : '' }}>
              <label class="form-check-label" for="ram_{{ $item->id }}">{{ $item->dung_luong }} GB</label>
            </div>
            @endforeach
          </div>
        </details>

        <!-- Filter Ổ cứng -->
        <details class="filter-group">
          <summary class="btn btn-outline-secondary text-black btn-sm">Ổ cứng</summary>
          <div class="filter-content p-3 bg-white shadow-sm">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_o_cung" id="ocung_all" value="" {{ !request('id_o_cung') ? 'checked' : '' }}>
              <label class="form-check-label" for="ocung_all">Tất cả</label>
            </div>
            @foreach($oCungs as $item)
            <div class="form-check">
              <input class="form-check-input" type="radio" name="id_o_cung" id="ocung_{{ $item->id }}" value="{{ $item->id }}" {{ request('id_o_cung') == $item->id ? 'checked' : '' }}>
              <label class="form-check-label" for="ocung_{{ $item->id }}">{{ $item->dung_luong }}</label>
            </div>
            @endforeach
          </div>
        </details>

        <!-- Filter buttons -->
        <button type="submit" class="btn btn-danger btn-sm">
          <i class="fa fa-filter me-1"></i> Bộ lọc
        </button>
        <a href="{{ route('client.home') }}" class="btn btn-outline-secondary btn-sm">Đặt lại</a>
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
        <a href="{{ $sp->ma_san_pham }}" class="text-decoration-none text-dark">
          <div class="product-card p-3 h-100 shadow-sm border-0 position-relative overflow-hidden rounded-4">
            <div class="position-relative">
              <img src="{{ asset('storage/' . ($bienThe->anh_dai_dien ?? $sp->anh_dai_dien)) }}"
                   class="img-fluid mb-2 rounded" alt="{{ $sp->ten }}"
                   style="height: 200px; width: 100%; object-fit: cover;">

              <!-- Badges -->
              @if ($sp->is_hot)
              <span class="badge badge-hot position-absolute top-0 start-0 m-2">
                <i class="fa-solid fa-fire me-1"></i> HOT
              </span>
              @endif

              @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
              <span class="badge badge-discount position-absolute top-0 end-0 m-2">
                -{{ round(100 * ($bienThe->gia_so_sanh - $bienThe->gia) / $bienThe->gia_so_sanh) }}%
              </span>
              @endif
            </div>

            <div class="d-flex flex-column h-100">
              <h6 class="fw-bold product-name mb-2" title="{{ $sp->ten }}">
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
                <div><i class="fa-solid fa-hdd me-1 text-secondary"></i> {{ $bienThe->oCung->dung_luong }} {{ $bienThe->oCung->loai }}</div>
                @endif
              </div>

              <div class="mb-2 mt-auto">
                @if ($bienThe && $bienThe->gia_so_sanh > $bienThe->gia)
                <span class="old-price text-muted text-decoration-line-through small">
                  {{ number_format($bienThe->gia_so_sanh) }}₫
                </span>
                @endif
                <div class="text-danger fw-bold fs-6">
                  {{ number_format($bienThe->gia ?? 0) }}₫
                </div>
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
/* Filter dropdown styles */
.filter-group {
  position: relative;
}

.filter-group summary {
  cursor: pointer;
  list-style: none;
  outline: none;
}

.filter-group summary::-webkit-details-marker {
  display: none;
}

.filter-group summary::after {
  content: '▼';
  font-size: 0.8em;
  margin-left: 0.5rem;
  transition: transform 0.2s;
}

.filter-group[open] summary::after {
  transform: rotate(180deg);
}

.filter-content {
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 200px;
  border-radius: 0.375rem;
  border: 1px solid #dee2e6;
  z-index: 1000;
  max-height: 300px;
  overflow-y: auto;
}

.filter-content .form-check {
  margin-bottom: 0.5rem;
}

.filter-content .form-check:last-child {
  margin-bottom: 0;
}

/* Product card styles */
.product-card {
  transition: all 0.3s ease;
  border-radius: 1rem;
  background: white;
  border: 1px solid #e9ecef;
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.product-name {
  height: 3em;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

/* Badge styles */
.badge-hot {
  background: linear-gradient(45deg, #ff6b6b, #ee5a52);
  color: white;
  font-size: 0.75rem;
  padding: 0.4rem 0.6rem;
  border-radius: 0.5rem;
}

.badge-discount {
  background: linear-gradient(45deg, #51cf66, #40c057);
  color: white;
  font-size: 0.75rem;
  padding: 0.4rem 0.6rem;
  border-radius: 0.5rem;
}

.badge-sale {
  background: linear-gradient(45deg, #339af0, #228be6);
  color: white;
  font-size: 0.75rem;
  padding: 0.4rem 0.6rem;
  border-radius: 0.5rem;
}

.badge-gift {
  background: linear-gradient(45deg, #ffd43b, #fab005);
  color: white;
  font-size: 0.75rem;
  padding: 0.4rem 0.6rem;
  border-radius: 0.5rem;
}

.old-price {
  font-size: 0.85rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .filter-bar {
    flex-direction: column;
    gap: 0.5rem;
  }

  .filter-content {
    position: static;
    min-width: auto;
    width: 100%;
    margin-top: 0.5rem;
  }

  .filter-group[open] .filter-content {
    display: block;
  }
}
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Auto submit form when filter changes
  const filterInputs = document.querySelectorAll('.filter-content input[type="radio"]');

  filterInputs.forEach(input => {
    input.addEventListener('change', function() {
      // Close the dropdown after selection
      const details = this.closest('details');
      if (details) {
        details.removeAttribute('open');
      }

      // Auto submit form
      setTimeout(() => {
        this.closest('form').submit();
      }, 100);
    });
  });

  // Close other dropdowns when opening one
  const detailsElements = document.querySelectorAll('details');

  detailsElements.forEach(details => {
    details.addEventListener('toggle', function() {
      if (this.open) {
        detailsElements.forEach(other => {
          if (other !== this && other.open) {
            other.removeAttribute('open');
          }
        });
      }
    });
  });

  // Close dropdowns when clicking outside
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.filter-group')) {
      detailsElements.forEach(details => {
        details.removeAttribute('open');
      });
    }
  });
});
</script>
@endpush
