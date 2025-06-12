@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Danh sách người dùng</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Tên đăng nhập</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->ho_ten }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->so_dien_thoai }}</td>
                            <td>{{ $user->ten_dang_nhap }}</td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($user->vai_tro) }}</span>
                            </td>
                            <td>
                                <span
                                    class="badge 
                                {{ $user->trang_thai == 'hoat_dong' ? 'bg-success' : ($user->trang_thai == 'vo_hieu' ? 'bg-danger' : 'bg-secondary') }}">
                                    {{ ucfirst($user->trang_thai) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Chỉnh
                                    sửa</a>
                                <form action="{{ route('admin.users.hide', $user) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Ẩn</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
