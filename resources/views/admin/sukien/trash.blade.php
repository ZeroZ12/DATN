@extends('admin.layouts.app')

@section('title', 'Thùng rác Sự Kiện')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">🗑️ Thùng rác - Sự kiện đã xóa</h2>
        <a href="{{ route('admin.sukien.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
    </div>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Sự Kiện</th>
                <th>Đã xóa lúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashedSuKiens as $sk)
                <tr>
                    <td>{{ $sk->id }}</td>
                    <td>{{ $sk->ten_su_kien }}</td>
                    <td>{{ $sk->deleted_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.sukien.restore', $sk->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.sukien.forceDelete', $sk->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa vĩnh viễn</button>
                        </form>
                    </td>
                </tr>
             @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Thùng rác trống.</td> {{-- Cập nhật colspan --}}
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center p-3">
            {{ $trashedSuKiens->links() }}
        </div>
    </div>
</div>
@endsection
