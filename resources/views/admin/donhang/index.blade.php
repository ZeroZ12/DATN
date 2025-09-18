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
        <div class="order-table-header" style="grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr;">
            <div>Sản phẩm</div>
            <div>Tổng đơn hàng</div>
            <div>Trạng thái</div>
            <div>Trạng thái vận chuyển giao hàng</div>
            <div>Trạng thái vận chuyển hoàn hàng</div>
            <div>Thao tác</div>
        </div>

        {{-- Danh sách đơn hàng --}}
        @forelse ($donHangs as $don)
           <div class="order-grid"
     data-ma="{{ $don->ma_don }}"
     data-email="{{ $don->user->email ?? '' }}"
     style="grid-template-columns: 3fr 1fr 1fr 1fr 1fr 1fr;">

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

                {{-- Trạng thái đơn --}}
                <div class="order-status">
                    @php $trangThai = $don->trang_thai; @endphp
                    <span class="status-badge status-{{ $trangThai }}">
                        {{ App\Models\DonHang::getTenTrangThai($trangThai) ?? 'Không xác định' }}
                    </span>
                   @if ($trangThai === 'da_huy')
    @php
        $nguoiHuy = $don->huy_boi ?? 'he_thong';
        $ycht = $don->yeuCauHoanTra;
        $text = '';

        if ($ycht) {
            // Nếu đã hoàn tiền
            if ($ycht->trang_thai === 'da_hoan_tien') {
                $text = 'Đã hoàn tiền cho người mua';
            }
            // Nếu đã phê duyệt, chờ người mua trả hàng
            elseif ($ycht->trang_thai === 'da_phe_duyet') {
                $text = 'Đơn hàng đã xác nhận yêu cầu hoàn trả, chờ người mua trả hàng';
            }
            // Đang vận chuyển trả hàng
            elseif ($ycht->trang_thai === 'dang_van_chuyen_tra_hang') {
                $text = 'Sản phẩm đang được giao trả về shop';
            }
            // Shop đã nhận lại hàng
            elseif ($ycht->trang_thai === 'da_nhan_hang') {
                $text = 'Shop đã nhận lại hàng, chờ admin hoàn tiền';
            }
            else {
                $text = 'Đang xử lý yêu cầu hoàn trả';
            }
        } else {
            // Trạng thái hủy bình thường
            $text = match ($nguoiHuy) {
                'khach_hang' => 'Đã hủy bởi khách hàng',
                'admin' => 'Đã hủy bởi quản trị viên',
                default => 'Đã hủy tự động bởi hệ thống',
            };
        }
    @endphp

    <div class="text-muted small">{{ $text }}</div>
@endif


                </div>

                <div class="order-status">

    <span>
        {{ App\Models\DonHang::getTenTrangThaiVcGiao($don->trang_thai_vc_giao_hang) ?: "Chưa giao"}}
    </span>
</div>

<div class="order-status">
    @if($don->yeuCauHoanTra)
        <span>
            {{ App\Models\YeuCauHoanTra::getTenTrangVcThaiHoan($don->yeuCauHoanTra->trang_thai_vc_hoan_hang) }}
        </span>
    @else
        <span ></span>
    @endif
</div>


                {{-- ✅ Trạng thái hoàn hàng --}}
                <!-- <div class="order-status">
                    @php $hoanTra = $don->yeuCauHoanTra; @endphp

                    @if ($hoanTra && in_array($don->trang_thai, ['giao_thanh_cong', 'hoan_thanh']))
                        <a href="{{ route('admin.hoan-tra.show', $hoanTra->id) }}" class="status-link">
                            <span class="status-hoan-tra status-{{ $hoanTra->trang_thai }}">
                                {{ App\Models\YeuCauHoanTra::getTenTrangThai($hoanTra->trang_thai) }}
                            </span>
                        </a>
                    @elseif ($hoanTra)
                        <span class="status-hoan-tra status-{{ $hoanTra->trang_thai }}">
                            {{ App\Models\YeuCauHoanTra::getTenTrangThai($hoanTra->trang_thai) }}
                        </span>
                    @else
                        <span class="status-hoan-tra status-chua_hoan_tra">Chưa yêu cầu</span>
                    @endif
                </div> -->




                {{-- Thao tác --}}
                {{-- Thao tác --}}
<div class="order-actions">
   @if ($don->yeuCauHoanTra)
    <a href="{{ route('admin.hoan-tra.show', $don->yeuCauHoanTra->id) }}"
       class="btn btn-sm btn-info mb-1">
        Xem Hoàn Hàng
    </a>
@endif


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
            {{-- Giao tiếp --}}
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}">
                @csrf
                <input type="hidden" name="trang_thai" value="dang_giao_hang">
                <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
                <button class="btn btn-sm btn-warning">Giao tiếp</button>
            </form>

            {{-- Hủy --}}
            <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}"
                  onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
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
        .order-table-header,
        .order-grid {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr 1fr 1fr;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            background: #fff;
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

        .status-da_huy {
            background: #dc3545;
        }

        .status-cho_xac_nhan {
            background: #ffc107;
            color: #000;
        }

        .status-da_xac_nhan {
            background: #007bff;
        }

        .status-cho_thanh_toan {
            background: rgb(43, 91, 143);
        }

        .status-chuan_bi_hang,
        .status-dang_giao_hang {
            background: #6c757d;
        }

        .status-giao_thanh_cong,
        .status-hoan_thanh {
            background: #28a745;
        }

        .status-giao_that_bai {
            background: #dc3545;
        }

        .status-yeu_cau_hoan_tra {
            background: #42463d;
        }

        .status-da_hoan_tien {
            background: #343a40;
        }

        .status-chua_hoan_tra {
            background: #adb5bd;
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

        .btn-sm.btn-danger {
            background-color: #dc3545;
        }

        .btn-sm.btn-success {
            background-color: #28a745;
        }

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

        .status-tabs .nav-link:hover {
            background-color: #ddd;
        }

        .status-tabs .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

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

        .status-hoan-tra {
            padding: 4px 10px;
            font-size: 0.875rem;
            border-radius: 20px;
            font-weight: 500;
            color: #fff;
            display: inline-block;
            white-space: nowrap;
        }

        .status-chua_hoan_tra {
            background-color: #adb5bd;
            /* xám nhạt - chưa có gì */
            color: #000;
        }

        .status-cho_phe_duyet {
            background-color: #ffc107;
            /* vàng - cảnh báo */
            color: #000;
        }

        .status-da_phe_duyet {
            background-color: #0d6efd;
            /* xanh dương - primary */
        }

        .status-tu_choi {
            background-color: #dc3545;
            /* đỏ - bị từ chối */
        }

        .status-dang_van_chuyen_tra_hang {
            background-color: #6f42c1;
            /* tím - đang vận chuyển */
        }

        .status-da_nhan_hang {
            background-color: #20c997;
            /* xanh ngọc - đã nhận */
        }

        .status-da_hoan_tien {
            background-color: #198754;
            /* xanh lá - đã hoàn tiền */
        }
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
        if (totalText) {
            totalText.textContent = `Tổng: ${count} Đơn hàng`;
        }
    }

    // Chỉ lọc khi ấn nút
    document.getElementById('applyFilterBtn').addEventListener('click', filterOrders);
</script>
@endpush
