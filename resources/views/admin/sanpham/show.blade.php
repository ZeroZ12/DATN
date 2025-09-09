@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container">
        <h1>Chi tiết sản phẩm: {{ $sanpham->ten }}</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Trở lại
                danh sách</a>
            <a href="{{ route('admin.sanpham.edit', $sanpham->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i>
                Sửa</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover table-light">
                    <tr>
                        <th style="width: 200px;">Tên sản phẩm</th>
                        <td>{{ $sanpham->ten }}</td>
                    </tr>
                    <tr>
                        <th>Loại sản phẩm</th>
                        <td>{{ $sanpham->co_bien_the ? 'Có biến thể' : 'Không có biến thể' }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>{{ $sanpham->danhMuc->ten ?? 'Không có danh mục' }}</td>
                    </tr>
                    <tr>
                        <th>Thương hiệu</th>
                        <td>{{ $sanpham->thuongHieu->ten ?? 'Không có thương hiệu' }}</td>
                    </tr>
                    <tr>
                        <th>Chip</th>
                        <td>{{ $sanpham->chip->ten ?? 'Không có chip' }}</td>
                    </tr>
                    <tr>
                        <th>Mainboard</th>
                        <td>{{ $sanpham->mainboard->ten ?? 'Không có mainboard' }}</td>
                    </tr>
                    <tr>
                        <th>GPU</th>
                        <td>{{ $sanpham->gpu->ten ?? 'Không có GPU' }}</td>
                    </tr>
                    <tr>
                        <th>Tản Nhiệt</th>
                        <td>{{ $sanpham->tannhiet->ten ?? 'Không có tản nhiệt' }}</td>
                    </tr>
                    <tr>
                        <th>Nguồn</th>
                        <td>{{ $sanpham->nguon->ten ?? 'Không có nguồn' }}</td>
                    </tr>
                    <tr>
                        <th>Vỏ Case</th>
                        <td>{{ $sanpham->case->ten ?? 'Không có vỏ case' }}</td>
                    </tr>
                    <tr>
                        <th>Bảo hành</th>
                        <td>{{ $sanpham->bao_hanh_thang }} tháng</td>
                    </tr>
                    @if (!$sanpham->co_bien_the)
                        <tr>
                            <th>Giá</th>
                            <td>{{ number_format($sanpham->gia) }} đ</td>
                        </tr>
                        <tr>
                            <th>Giá gốc</th>
                            <td>{{ $sanpham->gia_so_sanh ? number_format($sanpham->gia_so_sanh) . ' đ' : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Số lượng</th>
                            <td>{{ $sanpham->so_luong }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Ảnh đại diện</th>
                        <td>
                            @if ($sanpham->anh_dai_dien)
                                <img src="{{ asset('storage/' . $sanpham->anh_dai_dien) }}" alt="Ảnh sản phẩm"
                                    style="max-width: 150px;">
                            @else
                                <span class="text-muted">Không có ảnh</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ảnh phụ</th>
                        <td>
                            @if ($sanpham->anhPhu && $sanpham->anhPhu->count() > 0)
                                @foreach ($sanpham->anhPhu as $anh)
                                    <img src="{{ asset('storage/' . $anh->duong_dan) }}" alt="Ảnh phụ"
                                        style="max-width: 100px; margin-right: 10px;">
                                @endforeach
                            @else
                                <span class="text-muted">Không có ảnh phụ</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Hoạt động</th>
                        <td>{{ $sanpham->hoat_dong ? 'Có' : 'Không' }}</td>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <td>{!! $sanpham->mo_ta ?: 'Không có mô tả' !!}</td>
                    </tr>
                </table>

                @if ($sanpham->co_bien_the)
                    <h4 class="mt-4">Danh sách biến thể</h4>
                    <table class="table table-bordered table-hover table-light">
                        <thead>
                            <tr>
                                <th>RAM</th>
                                <th>Ổ Cứng</th>
                                <th>Giá</th>
                                <th>Giá Gốc</th>
                                <th>Tồn Kho</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sanpham->bienTheSanPhams as $variant)
                                <tr>
                                    <td>{{ $variant->ram->dung_luong ?? 'N/A' }}</td>
                                    <td>{{ $variant->oCung->loai }}-{{ $variant->oCung->dung_luong ?? 'N/A' }}</td>
                                    <td>{{ number_format($variant->gia) }} đ</td>
                                    <td>{{ $variant->gia_so_sanh ? number_format($variant->gia_so_sanh) . ' đ' : 'N/A' }}
                                    </td>
                                    <td>{{ $variant->ton_kho }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Không có biến thể nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .btn-primary,
        .btn-warning {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary:hover,
        .btn-warning:hover {
            background-color: #c82333;
            border-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        .btn-secondary {
            transition: all 0.2s ease-in-out;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
        }
    </style>
@endpush
