{{-- resources/views/admin/danhgias/edit.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Đánh giá')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Chỉnh sửa Đánh giá</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa Đánh giá #{{ $danhGia->id }}</h6>
                <a href="{{ route('admin.danhgias.index') }}" class="btn btn-secondary btn-sm">Quay lại danh sách</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.danhgias.update', $danhGia->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="id_product" class="form-label">Sản phẩm:</label>
                        <input type="text" class="form-control" value="{{ $danhGia->sanPham->ten ?? 'Không tồn tại' }}" disabled>
                        <input type="hidden" name="id_product" value="{{ $danhGia->id_product }}">
                    </div>

                    <div class="mb-3">
                        <label for="id_user" class="form-label">Người đánh giá:</label>
                        <input type="text" class="form-control" value="{{ $danhGia->user->ho_ten ?? 'Không tồn tại' }} ({{ $danhGia->user->email ?? 'N/A' }})" disabled>
                        <input type="hidden" name="id_user" value="{{ $danhGia->id_user }}">
                    </div>

                    <div class="mb-3">
                        <label for="so_sao" class="form-label">Số sao:</label>
                        <select name="so_sao" id="so_sao" class="form-control @error('so_sao') is-invalid @enderror">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('so_sao', $danhGia->so_sao) == $i ? 'selected' : '' }}>
                                    {{ $i }} sao
                                </option>
                            @endfor
                        </select>
                        @error('so_sao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="binh_luan" class="form-label">Bình luận:</label>
                        <textarea name="binh_luan" id="binh_luan" rows="5" class="form-control @error('binh_luan') is-invalid @enderror">{{ old('binh_luan', $danhGia->binh_luan) }}</textarea>
                        @error('binh_luan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="trang_thai" class="form-label">Trạng thái:</label>
                        <select name="trang_thai" id="trang_thai" class="form-control @error('trang_thai') is-invalid @enderror">
                            <option value="cho_duyet" {{ old('trang_thai', $danhGia->trang_thai) == 'cho_duyet' ? 'selected' : '' }}>Chờ duyệt</option>
                            <option value="da_duyet" {{ old('trang_thai', $danhGia->trang_thai) == 'da_duyet' ? 'selected' : '' }}>Đã duyệt</option>
                            <option value="tu_choi" {{ old('trang_thai', $danhGia->trang_thai) == 'tu_choi' ? 'selected' : '' }}>Từ chối</option>
                        </select>
                        @error('trang_thai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật Đánh giá</button>
                </form>
            </div>
        </div>
    </div>
@endsection