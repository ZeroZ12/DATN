@extends('admin.layouts.app')

@section('title', 'Thùng rác danh mục')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🗑️ Danh mục đã xóa mềm</h2>
            <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">⬅️ Quay lại danh mục</a>
        </div>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Thời gian xóa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($danhmucs as $dm)
                            <tr>
                                <td class="text-center">{{ $dm->id }}</td>
                                <td class="text-center">{{ $dm->ten }}</td>
                                <td class="text-center">{{ $dm->deleted_at->format('d/m/Y H:i:s') }}</td>
                                <td class="text-center">
                                    {{-- Nút Khôi phục --}}
                                    <form action="{{ route('admin.danhmuc.restore', $dm->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn khôi phục danh mục này? Các sản phẩm đã xóa mềm theo danh mục này cũng sẽ được khôi phục.')">
                                        @csrf
                                        {{-- Sử dụng @method('POST') vì restore là POST route, không phải PUT/PATCH --}}
                                        <button type="submit" class="btn btn-sm btn-success me-1">↩️ Khôi phục</button>
                                    </form>

                                    {{-- Nút Xóa vĩnh viễn --}}
                                    <form action="{{ route('admin.danhmuc.forceDelete', $dm->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn CÓ CHẮC chắn muốn XÓA VĨNH VIỄN danh mục này? Hành động này không thể hoàn tác và các sản phẩm liên quan cũng sẽ bị xóa vĩnh viễn!')">
                                        @csrf
                                        @method('DELETE') {{-- ForceDelete là DELETE route --}}
                                        <button type="submit" class="btn btn-sm btn-danger">🔥 Xóa vĩnh viễn</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không có danh mục nào trong thùng rác.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $danhmucs->links() }}
            </div>
        </div>
    </div>
@endsection