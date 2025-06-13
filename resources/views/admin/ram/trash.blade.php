@extends('admin.layouts.app')

@section('title', 'Thùng rác RAM')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Thùng rác - RAM đã xóa</h2>
        <a href="{{ route('admin.ram.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
    </div>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Dung lượng</th>
                <th>Đã xóa lúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rams as $ram)
                <tr>
                    <td>{{ $ram->id }}</td>
                    <td>{{ $ram->dung_luong }}</td>
                    <td>{{ $ram->deleted_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.ram.restore', $ram->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.ram.forceDelete', $ram->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa vĩnh viễn</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Thùng rác trống.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $rams->links() }}
@endsection
