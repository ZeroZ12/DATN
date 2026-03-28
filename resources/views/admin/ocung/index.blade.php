@extends('admin.layouts.app')

@section('title', 'Quản lý ổ cứng')

@section('content')
    <div class="container">
        <!-- Tiêu đề và hành động -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Danh sách ổ cứng</h2>
            <div>
                <a href="{{ route('admin.ocung.trash') }}" class="btn btn-outline-secondary me-2"> Thùng rác</a>
                <a href="{{ route('admin.ocung.create') }}" class="btn btn-primary">+ Thêm ổ cứng</a>
            </div>
        </div>

        <!-- Thông báo -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        <!-- Bảng dữ liệu -->
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Loại</th>
                            <th>Dung lượng</th>
                            <th>Giá</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($oCungs as $oCung)
                            <tr>
                                <td>{{ $oCung->id }}</td>
                                <td>{{ $oCung->loai }}</td>
                                <td>{{ $oCung->dung_luong }}</td>
                                @if (!empty($oCung->gia_sale)&& $oCung->gia_sale > 0 )
                                    {{-- Kiểm tra nếu giá không rỗng --}}
                                    <td>{{ number_format($oCung->gia_sale, 0, ',', '.') }} đ</td>
                                @else
                                    <td>{{ number_format($oCung->gia, 0, ',', '.') }} đ</td>
                                @endif
                                <td>{{ \Illuminate\Support\Str::limit(strip_tags($oCung->mo_ta), 100, '...') }}</td>
                                <td>
                                    <a href="{{ route('admin.ocung.edit', $oCung->id) }}" class="btn btn-sm btn-outline-warning">Sửa</a>
                                    <a href="{{ route('admin.ocung.show', $oCung->id) }}" class="btn btn-sm btn-outline-info">Xem</a>
                                    <form action="{{ route('admin.ocung.destroy', $oCung->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Chưa có ổ cứng nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center my-4">
                    <nav aria-label="Page navigation example"> {{-- Đổi aria-label rõ ràng hơn --}}
                        {{ $oCungs->links('pagination::bootstrap-5') }}
                    </nav>
                </div>


            </div>
        </div>
    </div>
@endsection


