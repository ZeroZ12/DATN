@extends('admin.layouts.app')

@section('title', 'Quản lý mã giảm giá')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách mã giảm giá</h2>
            <a href="{{ route('admin.magiamgia.create') }}" class="btn btn-primary">+ Thêm mã giảm giá</a>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card shadow-sm">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Mã</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Hoạt động</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maGiamGias as $maGiamGia)
                        <tr>
                            <td>{{ $maGiamGia->id }}</td>
                            <td>{{ $maGiamGia->ma }}</td>
                            <td>{{ $maGiamGia->loai == 'phan_tram' ? 'Phần trăm' : 'Tiền mặt' }}</td>
                            <td>
                                @if ($maGiamGia->loai === 'phan_tram')
                                    {{ $maGiamGia->gia_tri }}%
                                @else
                                    {{ number_format($maGiamGia->gia_tri, 0, ',', '.') }} VND
                                @endif
                            </td>

                            <td>{{ $maGiamGia->ngay_bat_dau ? \Carbon\Carbon::parse($maGiamGia->ngay_bat_dau)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td>{{ $maGiamGia->ngay_ket_thuc ? \Carbon\Carbon::parse($maGiamGia->ngay_ket_thuc)->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td>{{ $maGiamGia->hoat_dong ? 'Có' : 'Không' }}</td>
                            <td>
                                <a href="{{ route('admin.magiamgia.edit', $maGiamGia->id) }}"
                                    class="btn btn-sm btn-warning">Sửa</a>
                                <a href="{{ route('admin.magiamgia.show', $maGiamGia->id) }}"
                                    class="btn btn-sm btn-info">Xem</a>
                                <form action="{{ route('admin.magiamgia.destroy', $maGiamGia->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Chưa có mã giảm giá nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
