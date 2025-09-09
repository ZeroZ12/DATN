@extends('admin.layouts.app')

@section('title', 'Quản lý chip')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 text-primary fw-bold">🧠 Danh sách chip</h2>
            <div>
                <a href="{{ route('admin.chip.trash') }}" class="btn btn-outline-secondary me-2">🗑️ Thùng rác</a>
                <a href="{{ route('admin.chip.create') }}" class="btn btn-success">+ Thêm chip</a>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Tên chip</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($chips as $chip)
                            <tr>
                                <td>{{ $chip->id }}</td>
                                <td class="fw-semibold">{{ $chip->ten }}</td>
                                @if (!empty($chip->gia_sale)&& $chip->gia_sale > 0 )
                                    {{-- Kiểm tra nếu giá không rỗng --}}
                                    <td>{{ number_format($chip->gia_sale, 0, ',', '.') }} đ</td>
                                @else
                                    <td>{{ number_format($chip->gia, 0, ',', '.') }} đ</td>
                                @endif
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($chip->mo_ta), 100, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.chip.edit', $chip->id) }}" class="btn btn-sm btn-warning me-1">✏️
                                        Sửa</a>
                                    <a href="{{ route('admin.chip.show', $chip->id) }}" class="btn btn-sm btn-info me-1">👁️
                                        Xem</a>
                                    <form action="{{ route('admin.chip.destroy', $chip->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa chip này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có chip nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $chips->links('pagination::bootstrap-5') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>
@endsection