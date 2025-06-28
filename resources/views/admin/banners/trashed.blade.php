@extends('admin.layouts.app')

@section('title', 'Thùng rác Banner')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🗑️ Banner đã xóa mềm</h2>
            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary" title="Quay lại"><i class="fa fa-reply" aria-hidden="true"></i></a>
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
                            <th>Tên Banner</th>
                            <th>Trạng thái</th>
                            <th>Thời gian xóa</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td class="text-center">{{ $banner->id }}</td>
                                <td class="text-center">{{ $banner->title }}</td>
                                <td class="text-center">
                                    @if ($banner->deleted_at)
                                        <div class="hide btn btn-warning">
                                            Vô hiệu
                                        </div>
                                    @else
                                        <div class="show btn btn-success">
                                            Hoạt động
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $banner->deleted_at ? $banner->deleted_at->format('d/m/Y H:i:s') : 'Không xác định' }}
                                <td class="text-center">

                                    {{-- Nút Khôi phục --}}
                                    <form action="{{ route('admin.banner.restore', $banner->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn có chắc muốn khôi phục Banner này?')">
                                        @csrf
                                        {{-- Sử dụng @method('POST') vì restore là POST route, không phải PUT/PATCH --}}
                                        <button type="submit" class="btn btn-sm btn-success me-1" title="Khôi phục"><i class="fa fa-reply" aria-hidden="true"></i></button>
                                    </form>

                                    {{-- Nút Xóa vĩnh viễn --}}
                                    <form action="{{ route('admin.banner.forceDelete', $banner->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Bạn CÓ CHẮC chắn muốn XÓA VĨNH VIỄN Banner này?')">
                                        @csrf
                                        @method('DELETE') {{-- ForceDelete là DELETE route --}}
                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa vĩnh viễn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không có Banner nào trong thùng rác.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-center">
                {{ $banners->links() }}
            </div>
        </div>
    </div>
@endsection