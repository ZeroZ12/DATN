@extends('admin.layouts.app')

@section('title', 'Chi tiết Tản nhiệt')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Chi tiết Sự Kiện: {{ $suKien->ten_su_kien }}</h2>

        <div class="card p-4 mb-4">
            <h5 class="mb-3">Thông tin chi tiết</h5>
            <ul class="list-unstyled">
                <li><strong>ID:</strong> {{ $suKien->id }}</li>
                <li><strong>Ngày bắt đầu:</strong> {{ $suKien->ngay_bat_dau->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày kết thúc:</strong> {{ $suKien->ngay_ket_thuc->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày tạo:</strong> {{ $suKien->created_at->format('d/m/Y H:i') }}</li>
                <li><strong>Ngày cập nhật:</strong> {{ $suKien->updated_at->format('d/m/Y H:i') }}</li>
                <li><strong>Trạng thái hiển thị:</strong> 
                    @if($suKien->hien_thi)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-secondary">Ẩn</span>
                    @endif
                </li>
            </ul>
        </div>

        <div class="card p-4 mb-4">
            <h5 class="mb-3">Sản phẩm tham gia sự kiện</h5>
            @if($suKien->sanPhams->isNotEmpty() || $suKien->bienTheSanPhams->isNotEmpty())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Biến thể</th>
                            <th>Giá sự kiện</th>
                            <th>Giá gốc</th>
                            <th>Giới hạn số lượng bán ra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suKien->sanPhams as $sanPham)
                            <tr>
                                <td>@if($sanPham->anh_dai_dien)
                                        <img src="{{ asset('storage/' . $sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten }}" class="img-thumbnail" style="width: 100px;height: 100px;">
                                    @else
                                        <span class="text-muted">Chưa có hình ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $sanPham->ten }}</td>
                                <td>Không có biến thể</td>
                                <td>{{ number_format($sanPham->pivot->gia_su_kien, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($sanPham->pivot->gia_goc, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $sanPham->pivot->so_luong_gioi_han ?? 'Không giới hạn' }}</td>
                            </tr>
                        @endforeach
                        @foreach($suKien->bienTheSanPhams as $bienThe)
                            <tr>
                                <td>@if($bienThe->sanPham->anh_dai_dien)
                                        <img src="{{ asset('storage/' . $bienThe->sanPham->anh_dai_dien) }}" alt="{{ $bienThe->sanPham->ten }}" class="img-thumbnail" style="width: 100px;height: 100px;">
                                    @else
                                        <span class="text-muted">Chưa có hình ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $bienThe->sanPham->ten }}</td>
                                <td>{{ $bienThe->ma_bien_the }}</td>
                                <td>{{ number_format($bienThe->pivot->gia_su_kien, 0, ',', '.') }} VNĐ</td>
                                <td>{{ number_format($bienThe->pivot->gia_goc, 0, ',', '.') }} VNĐ</td>
                                <td>{{ $bienThe->pivot->so_luong_gioi_han ?? 'Không giới hạn' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Chưa có sản phẩm hoặc biến thể nào tham gia sự kiện.</p>
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.sukien.index') }}" class="btn btn-secondary">↩️ Quay lại danh sách</a>
            <a href="{{ route('admin.sukien.edit', $suKien->id) }}" class="btn btn-warning">✏️ Chỉnh sửa</a>
        </div>
    </div>
@endsection
