@extends('admin.layouts.app')
@section('title', 'Danh Sách Yêu Cầu Hoàn Trả')
@section('content')
    <div class="container-fluid py-3">
        <h2 class="mb-4 fw-bold">Danh sách yêu cầu hoàn trả</h2>
        <form method="GET" class="mb-3 row g-2 align-items-center">
            <div class="col-auto">
                <select name="trang_thai" class="form-select" onchange="this.form.submit()">
                    @foreach ($trangThaiHienThi as $key => $label)
                        <option value="{{ $key }}" {{ request('trang_thai') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Lọc</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Mã hoàn trả</th>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>SĐT liên hệ</th>
                        <th>Trạng thái</th>
                        <th>Admin xác nhận</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($danhSach as $item)
                        <tr>
                            <td>{{ ($danhSach->currentPage() - 1) * $danhSach->perPage() + $loop->iteration }}</td>
                            <td>{{ $item->ma_hoan_tra }}</td>
                            <td>{{ $item->donHang->ma_don ?? '---' }}</td>
                            <td>{{ $item->donHang->user->ho_ten ?? '---' }}</td>
                            <td>{{ $item->sdt_lien_he }}</td>
                            <td>{{ $item->trang_thai }}</td>
                            <td>{{ $item->admin_hoan_tra ?? '---' }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.hoan-tra.show', $item->id) }}" class="btn btn-sm btn-info">Xem chi
                                    tiết</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Không có yêu cầu hoàn trả nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $danhSach->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
