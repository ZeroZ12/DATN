@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="title">Quản lý đơn hàng</h2>

    {{-- Tabs lọc --}}
    <div class="status-tabs mb-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ route('admin.don-hang.index') }}"
                   class="nav-link {{ request('trang_thai') ? '' : 'active' }}">Tất cả</a>
            </li>
            @foreach (App\Models\DonHang::TRANG_THAI as $trangThai)
                <li class="nav-item">
                    <a href="{{ route('admin.don-hang.index', ['trang_thai' => $trangThai]) }}"
                       class="nav-link {{ request('trang_thai') == $trangThai ? 'active' : '' }}">
                        {{ App\Models\DonHang::getTenTrangThai($trangThai) }}
                    </a>
                </li>
            @endforeach
            <li class="nav-item">
                <a href="{{ route('admin.don-hang.index', ['trang_thai' => 'hoan_tra']) }}"
                   class="nav-link {{ request('trang_thai') == 'hoan_tra' ? 'active' : '' }}">
                    Yêu cầu hoàn trả
                </a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Bộ lọc --}}
    <div class="filter-bar mb-3 d-flex justify-content-end">
        <div class="input-group" style="max-width: 500px;">
            <input type="text" id="orderFilterInput" class="form-control mx-2" placeholder="Nhập mã đơn hàng hoặc email">
            <button id="applyFilterBtn" class="btn btn-outline-primary">Áp dụng</button>
        </div>
    </div>

    <h5 class="total-count mb-1">Tổng: {{ $donHangs->total() }} Đơn hàng</h5>

    {{-- Tiêu đề cột --}}
    <div class="order-table-header">
        <div>Sản phẩm</div>
        <div>Tổng tiền</div>
        <div>Trạng thái</div>
        <div>Vận chuyển chiều giao hàng</div>
        <div>Vận chuyển hoàn hàng</div>
        <div>Thao tác</div>
    </div>

    {{-- Danh sách đơn hàng --}}
    @forelse ($donHangs as $don)
        <div class="order-grid"
             data-ma="{{ $don->ma_don }}"
             data-email="{{ $don->user->email ?? '' }}">

            {{-- Sản phẩm --}}
            <div class="order-products">
                <div class="order-user">
                    <div class="username">
                        <i class="fa fa-user-circle"></i>
                        {{ $don->user->ho_ten ?? '---' }} ({{ $don->user->email ?? '---' }})
                    </div>
                    <div class="order-code">Mã đơn hàng: {{ $don->ma_don }}</div>
                </div>
                @foreach ($don->chiTietDonHangs as $item)
                    <div class="order-item">
                        <img src="{{ asset('storage/' . $item->sanPham->anh_dai_dien) }}" class="item-img">
                        <div class="item-detail">
                            <div class="item-name">{{ $item->sanPham->ten ?? '---' }}</div>
                            @if ($item->bienTheSanPham)
                                <div class="item-variation">
                                    Mã biến thể: {{ $item->bienTheSanPham->ma_bien_the ?? '---' }} <br>
                                    RAM: {{ $item->bienTheSanPham->ram->dung_luong ?? '---' }} |
                                    Ổ cứng: {{ $item->bienTheSanPham->oCung->loai ?? '---' }} -
                                    {{ $item->bienTheSanPham->oCung->dung_luong ?? '---' }}
                                </div>
                            @else
                                <div class="item-variation">
                                    Thương hiệu: {{ $item->sanPham->thuongHieu->ten ?? '---' }}
                                </div>
                            @endif
                        </div>
                        <div class="item-qty"><span style="color: blue">x{{ $item->so_luong }}</span></div>
                    </div>
                @endforeach
            </div>

            {{-- Tổng tiền --}}
            <div class="order-total">
                <div>{{ number_format($don->tong_tien, 0) }}đ</div>
                <div class="text-muted small">{{ $don->phuongThucThanhToan->ten ?? '---' }}</div>
            </div>

            {{-- Trạng thái --}}
            <div class="order-status">
                @php $trangThai = $don->trang_thai; @endphp
                <span class="status-badge status-{{ $trangThai }}">
                    {{ App\Models\DonHang::getTenTrangThai($trangThai) ?? 'Không xác định' }}
                </span>
                @if ($trangThai === 'da_huy')
                    @php
                        $nguoiHuy = $don->huy_boi ?? 'he_thong';
                        $text = match ($nguoiHuy) {
                            'khach_hang' => 'Đã hủy bởi khách hàng',
                            'admin' => 'Đã hủy bởi quản trị viên',
                            default => 'Đã hủy tự động bởi hệ thống',
                        };
                    @endphp
                    <div class="text-muted small">{{ $text }}</div>
                @endif
            </div>

            {{-- Vận chuyển giao --}}
            <div class="order-shipping">
                <span class="status-badge status-{{ $don->trang_thai_vc_giao_hang }}">
                   {{ App\Models\DonHang::getTenTrangThaiVCGiaoHang($don->trang_thai_vc_giao_hang) }}
                </span>
            </div>

            {{-- Vận chuyển hoàn --}}
            <div class="order-shipping-return">
                <span class="status-badge status-{{ $don->trang_thai_vc_hoan }}">
                  {{ App\Models\DonHang::getTenTrangThaiVCHoanHang($don->trang_thai_vc_hoan) }}
                </span>
            </div>

            {{-- Thao tác --}}
            <div class="order-actions">
                <a href="{{ route('admin.don-hang.show', $don->id) }}" class="btn-view mb-1">Xem</a>
                <div class="btn-group-action">
                    @if ($trangThai === 'cho_xac_nhan')
                        <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                            @csrf
                            <input type="hidden" name="trang_thai" value="da_xac_nhan">
                            <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                            <button class="btn btn-sm btn-success">Xác nhận</button>
                        </form>
                        <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}"
                              onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
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
                        <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}"
                              onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
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
                    @elseif ($trangThai === 'giao_that_bai')
                        <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                            @csrf
                            <input type="hidden" name="trang_thai" value="dang_giao_hang">
                            <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                            <button class="btn btn-sm btn-warning">Giao tiếp</button>
                        </form>
                        <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}"
                              onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                            @csrf
                            <input type="hidden" name="trang_thai" value="da_huy">
                            <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                            <button class="btn btn-sm btn-danger">Hủy</button>
                        </form>
                        {{-- Hoàn trả --}}
@elseif ($trangThai === 'yeu_cau_hoan_tra')
    <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
        @csrf
        <input type="hidden" name="trang_thai" value="da_phe_duyet">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Phê duyệt</button>
    </form>
    <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
        @csrf
        <input type="hidden" name="trang_thai" value="tu_choi_hoan">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-danger">Từ chối</button>
    </form>
@elseif ($trangThai === 'dang_tra_hang')
    <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
        @csrf
        <input type="hidden" name="trang_thai" value="shop_da_nhan_hang">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Shop đã nhận hàng</button>
    </form>
@elseif ($trangThai === 'shop_da_nhan_hang')
    <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
        @csrf
        <input type="hidden" name="trang_thai" value="da_hoan_tien">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Hoàn tiền ngay</button>
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
    .order-table-header,
    .order-grid {
        display: grid;
        grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr;
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        background: #fff;
        align-items: center;
        gap: 5px;
    }

    .order-table-header {
        background: #f5f5f5;
        font-weight: bold;
    }

    .order-products {
        border-right: 1px dashed #ccc;
    }

    .order-user {
        background: #fafafa;
        padding: 8px 12px;
        border-bottom: 1px solid #ddd;
    }

    .order-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-bottom: 1px dashed #eee;
    }

    .item-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 12px;
    }

    .item-detail {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
    }

    .item-variation {
        font-size: 0.85rem;
        color: #777;
    }

    .item-qty {
        font-weight: bold;
        white-space: nowrap;
    }

    .order-total,
    .order-status,
    .order-shipping,
    .order-shipping-return,
    .order-actions {
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-left: 1px dashed #eee;
        text-align: center;
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.9rem;
        color: #fff;
    }

    .btn-view,
    .btn-sm {
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
    .btn-sm.btn-warning { background-color: #ffc107; color: #000; }

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

    .status-cho_xac_nhan { background-color: #ffc107; color:#000; }
.status-da_xac_nhan { background-color: #007bff; }
.status-chuan_bi_hang { background-color: #6c757d; }
.status-dang_giao_hang { background-color: #6c757d; }
.status-giao_thanh_cong { background-color: #28a745; }
.status-giao_that_bai { background-color: #dc3545; }
.status-da_huy { background-color: #dc3545; }
.status-hoan_tra { background-color: #42463d; }
.status-yeu_cau_hoan_tra {
    background-color: #42463d; /* xám đậm */
    color: #fff;
}

.status-cho_phe_duyet {
    background-color: #ffc107; /* vàng */
    color: #000;
}
.status-dang_giao {
    background-color: #7cec21ff; /* vàng */
    color: #000;
}


.status-da_phe_duyet {
    background-color: #0d6efd; /* xanh dương */
    color: #fff;
}

.status-dang_tra {
    background-color: #6f42c1; /* tím */
    color: #fff;
}
.status-dang_tra_hang {
    background-color: #66f061ff; /* tím */
    color: #fff;
}

.status-shop_da_nhan_hang {
    background-color: #20c997; /* xanh ngọc */
    color: #fff;
}

.status-da_hoan_tien {
    background-color: #198754; /* xanh lá */
    color: #fff;
}

.status-tu_choi_hoan_tien {
    background-color: #dc3545; /* đỏ */
    color: #fff;
}
/* Vận chuyển - trạng thái */
.status-chua_giao {
    background-color: #ffc107; /* vàng nhạt */
    color: #000;
}
.status-hoan_thanh {
    background-color: #0ce04bff; /* vàng nhạt */
    color: #000;
}

.status-da_giao {
    background-color: #28a745; /* xanh lá */
    color: #fff;
}

.status-that_bai {
    background-color: #dc3545; /* đỏ */
    color: #fff;
}

.status-khong_xac_dinh {
    background-color: #adb5bd; /* xám nhạt */
    color: #000;
}

/* Ví dụ thêm cho trạng thái yêu cầu hoàn trả */
.status-yeu_cau_hoan_tra {
    background-color: #42463d; /* xám đậm */
    color: #fff;
}


    .status-tabs .nav-link:hover { background-color: #ddd; }
    .status-tabs .nav-link.active { background-color: #007bff; color: #fff; }

    .btn-group-action { display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; margin-top: 6px; }
    .btn-group-action form { display: inline; }
</style>
@endpush

@push('scripts')
<script>
function filterOrders() {
    const keyword = document.getElementById('orderFilterInput').value.trim().toLowerCase();
    const orders = document.querySelectorAll('.order-grid');
    let count = 0;
    orders.forEach(order => {
        const maDon = (order.getAttribute('data-ma') || '').toLowerCase();
        const email = (order.getAttribute('data-email') || '').toLowerCase();
        const matched = maDon.includes(keyword) || email.includes(keyword);
        order.style.display = matched ? '' : 'none';
        if (matched) count++;
    });
    const totalText = document.querySelector('.total-count');
    if (totalText) totalText.textContent = `Tổng: ${count} Đơn hàng`;
}
document.getElementById('applyFilterBtn').addEventListener('click', filterOrders);
</script>
@endpush
