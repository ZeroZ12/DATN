@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h2 class="title">Quản lý đơn hàng</h2>

    {{-- Tabs lọc --}}
    <div class="status-tabs">
        <a href="{{ route('admin.don-hang.index') }}" class="tab {{ request('trang_thai') ? '' : 'active' }}">Tất cả</a>

        @foreach (App\Models\DonHang::TRANG_THAI as $trangThai)
            <a href="{{ route('admin.don-hang.index', ['trang_thai' => $trangThai]) }}"
               class="tab {{ request('trang_thai') == $trangThai ? 'active' : '' }}">
                {{ App\Models\DonHang::getTenTrangThai($trangThai) }}
            </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="table-container">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donHangs as $don)
                    <tr>
                        <td>{{ $don->ma_don }}</td>
                        <td>{{ $don->user->ho_ten ?? '---' }}</td>
                        <td>{{ number_format($don->tong_tien, 0) }}đ</td>
                        <td>
                            <span class="status-badge status-{{ $don->trang_thai }}">
                                {{ App\Models\DonHang::getTenTrangThai($don->trang_thai) }}
                            </span>
                        </td>
                        <td>{{ $don->created_at->format('d/m/Y H:i') }}</td>
                        <td style="min-width: 200px;">
                            <a href="{{ route('admin.don-hang.show', $don->id) }}" class="btn-view">Xem</a>

                            {{-- Nút cập nhật trạng thái --}}
                            @php $trangThai = $don->trang_thai; @endphp

                            @if ($trangThai === 'cho_xac_nhan')
                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="da_xac_nhan">
                                    <button class="btn-view btn-success">Xác nhận</button>
                                </form>

                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="da_huy">
                                    <button class="btn-view btn-danger">Hủy</button>
                                </form>

                            @elseif ($trangThai === 'da_xac_nhan')
                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="chuan_bi_hang">
                                    <button class="btn-view btn-success">Chuẩn bị</button>
                                </form>

                            @elseif ($trangThai === 'chuan_bi_hang')
                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="dang_giao_hang">
                                    <button class="btn-view btn-success">Giao hàng</button>
                                </form>

                            @elseif ($trangThai === 'dang_giao_hang')
                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="giao_thanh_cong">
                                    <button class="btn-view btn-success">Đã giao</button>
                                </form>

                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="giao_that_bai">
                                    <button class="btn-view btn-danger">Thất bại</button>
                                </form>

                            @elseif ($trangThai === 'giao_thanh_cong')
                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="hoan_thanh">
                                    <button class="btn-view btn-success">Hoàn thành</button>
                                </form>

                                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $don->id) }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="trang_thai" value="da_hoan_tien">
                                    <button class="btn-view btn-warning">Hoàn tiền</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Phân trang --}}
    <div class="pagination-wrap">
        {{ $donHangs->withQueryString()->links() }}
    </div>

</div>
@endsection

@push('css')
<style>
.title {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 1rem;
}
.status-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 1rem;
}
.status-tabs .tab {
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    color: #333;
    background: #fff;
    transition: all 0.2s;
}
.status-tabs .tab:hover {
    background: #f1f1f1;
}
.status-tabs .tab.active {
    background: #ff5722;
    color: #fff;
    border-color: #ff5722;
}
.table-container {
    overflow-x: auto;
}
.order-table {
    width: 100%;
    border-collapse: collapse;
}
.order-table th, .order-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}
.order-table thead {
    background: #f5f5f5;
    font-weight: bold;
}
.status-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.9rem;
    color: #fff;
}
.status-cho_xac_nhan { background: #ffc107; color: #000; }
.status-cho_thanh_toan { background: #17a2b8; }
.status-da_xac_nhan { background: #007bff; }
.status-chuan_bi_hang { background: #6c757d; }
.status-dang_giao_hang { background: #6c757d; }
.status-giao_thanh_cong { background: #28a745; }
.status-giao_that_bai { background: #dc3545; }
.status-hoan_thanh { background: #28a745; }
.status-da_huy { background: #dc3545; }
.status-da_hoan_tien { background: #343a40; }
.btn-view {
    padding: 4px 10px;
    background: #007bff;
    color: #fff;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background 0.2s;
    margin: 2px 0;
    display: inline-block;
}
.btn-view:hover {
    background: #0056b3;
}
.btn-success { background: #28a745; }
.btn-danger { background: #dc3545; }
.btn-warning { background: #ffc107; color: #000; }
.pagination-wrap {
    margin-top: 1rem;
}
</style>
@endpush
