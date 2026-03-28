@extends('admin.layouts.app')

@section('title', 'Quản lý RAM')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 text-primary fw-bold">📦 Danh sách RAM</h2>
            <div>
                <a href="{{ route('admin.ram.trash') }}" class="btn btn-outline-secondary me-2"> Thùng rác</a>
                <a href="{{ route('admin.ram.create') }}" class="btn btn-success">+ Thêm RAM mới</a>
            </div>
        </div>

        <!-- Thông báo thành công -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <!-- Bảng RAM -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Dung lượng</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rams as $ram)
                            <tr>
                                <td>{{ $ram->id }}</td>
                                <td class="fw-semibold">{{ $ram->dung_luong }}</td>
                                @if (!empty($ram->gia_sale)&& $ram->gia_sale > 0 )
                                    {{-- Kiểm tra nếu giá không rỗng --}}
                                    <td>{{ number_format($ram->gia_sale, 0, ',', '.') }} đ</td>
                                @else
                                    <td>{{ number_format($ram->gia, 0, ',', '.') }} đ</td>
                                @endif
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($ram->mo_ta), 100, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.ram.edit', $ram->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                         Sửa
                                    </a>
                                    <a href="{{ route('admin.ram.show', $ram->id) }}" class="btn btn-sm btn-outline-info me-1">
                                         Xem
                                    </a>
                                    <form action="{{ route('admin.ram.destroy', $ram->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa RAM này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"> Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có RAM nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $rams->links('pagination::bootstrap-5') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>
@endsection


