@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="title">Quản lý đơn hàng</h2>

    {{-- Tabs lọc --}}
    <div class="status-tabs mb-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ route('admin.don-hang.index') }}"
                   class="nav-link {{ request('trang_thai') ? '' : 'active' }}">
                    Tất cả
                </a>
            </li>
            @foreach (App\Models\DonHang::TRANG_THAI as $trangThai)
                <li class="nav-item">
                    <a href="{{ route('admin.don-hang.index', ['trang_thai' => $trangThai]) }}"
                       class="nav-link {{ request('trang_thai') == $trangThai ? 'active' : '' }}">
                        {{ App\Models\DonHang::getTenTrangThai($trangThai) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Bộ lọc --}}
    <div class="filter-bar mb-3">
        <input type="text" placeholder="Nhập Mã đơn hàng" class="form-control d-inline w-auto" style="width: 250px;">
        <button class="btn btn-outline-primary">Áp dụng</button>
    </div>

    <h5 class="total-count">{{ $donHangs->total() }} Đơn hàng</h5>

    {{-- Tiêu đề cột --}}
    <div class="order-table-header">
        <div>Sản phẩm</div>
        <div>Tổng đơn hàng</div>
        <div>Trạng thái</div>
        <div>Thao tác</div>
    </div>

    {{-- Danh sách đơn hàng --}}
    @forelse ($donHangs as $don)
        <div class="order-grid">
            {{-- Cột 1: Sản phẩm --}}
            <div class="order-products">
                <div class="order-user">
                    <div class="username">
                        <i class="fa fa-user-circle"></i> {{ $don->user->ho_ten ?? '---' }}
                    </div>
                    <div class="order-code">Mã đơn hàng: {{ $don->ma_don }}</div>
                </div>
                @foreach ($don->chiTietDonHangs as $item)
                    <div class="order-item">
                      <img src="{{ asset('storage/' . $item->sanPham->anh_dai_dien) }}" class="item-img">

                        <div class="item-detail">
                            <div class="item-name">{{ $item->sanPham->ten ?? '---' }}</div>
                            <div class="item-variation">Mã biến thể: {{ $item->bienTheSanPham->ma_bien_the ?? '---' }}</div>
                        </div>
                        <div class="item-qty">x{{ $item->so_luong }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Cột 2: Tổng tiền --}}
            <div class="order-total">
                <div>{{ number_format($don->tong_tien, 0) }}đ</div>
                <div class="text-muted small">{{ $don->phuongThucThanhToan->ten ?? '---' }}</div>
            </div>

          {{-- Cột 3: Trạng thái --}}
<div class="order-status">
    @php $trangThai = $don->trang_thai; @endphp
    <span class="status-badge status-{{ $trangThai }}">
        {{ App\Models\DonHang::getTenTrangThai($trangThai) ?? 'Không xác định' }}
    </span>

    @if ($trangThai === 'da_huy')
        <div class="text-muted small">Đã hủy tự động bởi hệ thống</div>
    @endif
</div>

{{-- Cột 4: Thao tác --}}
<div class="order-actions">
    <a href="{{ route('admin.don-hang.show', $don->id) }}" class="btn-view mb-1">Xem</a>

    {{-- Các button chuyển trạng thái nằm ngang --}}
    <div class="btn-group-action">
        @if ($trangThai === 'cho_xac_nhan')
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="da_xac_nhan">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-success">Xác nhận</button>
            </form>
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="da_huy">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-danger">Hủy</button>
            </form>

        @elseif ($trangThai === 'da_xac_nhan')
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="chuan_bi_hang">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-success">Chuẩn bị</button>
            </form>
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="da_huy">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-danger">Hủy</button>
            </form>

        @elseif ($trangThai === 'chuan_bi_hang')
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="dang_giao_hang">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-success">Giao hàng</button>
            </form>

        @elseif ($trangThai === 'dang_giao_hang')
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="giao_thanh_cong">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-success">Đã giao</button>
            </form>
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="giao_that_bai">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-danger">Thất bại</button>
            </form>

        @elseif ($trangThai === 'yeu_cau_hoan_tra')
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="da_hoan_tien">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-success">Hoàn tiền</button>
            </form>
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="da_huy">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-danger">Hủy</button>
            </form>
        @endif
    </div>
</div>


        </div>
    @empty
        <div class="alert alert-warning text-center">Không có đơn hàng nào.</div>
    @endforelse

    <div class="pagination-wrap mt-3">
        {{ $donHangs->withQueryString()->links() }}
    </div>
</div>
@endsection

@push('css')
<style>
    .btn-group-action {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 6px;
}

.btn-group-action form {
    display: inline;
}

    .order-table-header, .order-grid {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr;
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        background: #fff;
    }
    .order-table-header { background: #f5f5f5; font-weight: bold; }

    .order-products { border-right: 1px dashed #ccc; }
    .order-user { background: #fafafa; padding: 8px 12px; border-bottom: 1px solid #ddd; }
    .order-item { display: flex; align-items: center; padding: 8px 12px; border-bottom: 1px dashed #eee; }
    .item-img { width: 50px; height: 50px; object-fit: cover; margin-right: 12px; }
    .item-detail { flex: 1; }
    .item-name { font-weight: 500; }
    .item-variation { font-size: 0.85rem; color: #777; }
    .item-qty { font-weight: bold; white-space: nowrap; }

    .order-total, .order-status, .order-actions {
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-left: 1px dashed #eee;
        text-align: center;
    }

    .btn-view, .btn-sm {
        padding: 6px 10px;
        background: #007bff;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.9rem;
        margin-top: 5px;
    }
    .btn-sm.btn-danger { background-color: #dc3545; }
    .btn-sm.btn-success { background-color: #28a745; }

    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.9rem;
        color: #fff;
    }

    .status-da_huy { background: #dc3545; }
    .status-cho_xac_nhan { background: #ffc107; color: #000; }
    .status-da_xac_nhan { background: #007bff; }
    .status-chuan_bi_hang,
    .status-dang_giao_hang { background: #6c757d; }
    .status-giao_thanh_cong,
    .status-hoan_thanh { background: #28a745; }
    .status-giao_that_bai { background: #dc3545; }
    .status-yeu_cau_hoan_tra { background: #42463d; }
    .status-da_hoan_tien { background: #343a40; }

    .status-tabs .nav-pills {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        white-space: nowrap;
        background: #fff;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .status-tabs .nav-link {
        border-radius: 20px;
        padding: 6px 14px;
        color: #333;
        background-color: #f2f2f2;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .status-tabs .nav-link:hover { background-color: #ddd; }
    .status-tabs .nav-link.active { background-color: #007bff; color: #fff; }
</style>
@endpush
