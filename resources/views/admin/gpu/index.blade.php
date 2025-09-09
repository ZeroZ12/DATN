@extends('admin.layouts.app')

@section('title', 'Quản lý GPU')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 text-primary fw-bold">🎮 Danh sách GPU</h2>
            <div>
                <a href="{{ route('admin.gpu.trash') }}" class="btn btn-outline-secondary me-2">
                    🗑️ Thùng rác
                </a>
                <a href="{{ route('admin.gpu.create') }}" class="btn btn-success">
                    + Thêm GPU mới
                </a>
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
                            <th scope="col">#ID</th>
                            <th scope="col">🧩 Tên GPU</th>
                            <th>Giá</th>
                            <th scope="col">📄 Mô tả</th>
                            <th scope="col" class="text-center">⚙️ Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gpus as $gpu)
                            <tr>
                                <td>{{ $gpu->id }}</td>
                                <td class="fw-semibold">{{ $gpu->ten }}</td>
                                @if (!empty($gpu->gia_sale)&& $gpu->gia_sale > 0 )
                                    {{-- Kiểm tra nếu giá không rỗng --}}
                                    <td>{{ number_format($gpu->gia_sale, 0, ',', '.') }} đ</td>
                                @else
                                    <td>{{ number_format($gpu->gia, 0, ',', '.') }} đ</td>
                                @endif
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($gpu->mo_ta), 100, '...') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.gpu.edit', $gpu->id) }}" class="btn btn-warning btn-sm me-1">
                                        ✏️ Sửa
                                    </a>
                                    <a href="{{ route('admin.gpu.show', $gpu->id) }}" class="btn btn-info btn-sm me-1">
                                        👁️ Xem
                                    </a>
                                    <form action="{{ route('admin.gpu.destroy', $gpu->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa GPU này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">🗑️ Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có GPU nào được thêm.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $gpus->links('pagination::bootstrap-5') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>
@endsection