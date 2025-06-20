@extends('admin.layouts.app')

@section('title', 'Chi tiết mã giảm giá')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chi tiết mã giảm giá: {{ $maGiamGia->ma }}</h2>

        <div class="card p-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $maGiamGia->id }}</li>
                <li><strong>Mã:</strong> {{ $maGiamGia->ma }}</li>
                <li><strong>Loại:</strong> {{ $maGiamGia->loai == 'phan_tram' ? 'Phần trăm' : 'Tiền mặt' }}</li>
                <li><strong>Giá trị:</strong> {{ $maGiamGia->gia_tri }}</li>
                <li><strong>Ngày bắt đầu:</strong>
                    {{ !empty($maGiamGia->ngay_bat_dau) ? \Carbon\Carbon::parse($maGiamGia->ngay_bat_dau)->format('d/m/Y') : 'N/A' }}
                </li>
                <li><strong>Ngày kết thúc:</strong>
                    {{ !empty($maGiamGia->ngay_ket_thuc) ? \Carbon\Carbon::parse($maGiamGia->ngay_ket_thuc)->format('d/m/Y') : 'N/A' }}
                </li>
                <li><strong>Hoạt động:</strong> {{ $maGiamGia->hoat_dong ? 'Có' : 'Không' }}</li>
                <li><strong>Ngày tạo:</strong> {{ $maGiamGia->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $maGiamGia->updated_at->format('d/m/Y H:i') }}</li>
            </ul>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.magiamgia.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="{{ route('admin.magiamgia.edit', $maGiamGia->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        </div>
    </div>
@endsection