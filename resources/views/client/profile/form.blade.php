{{-- resources/views/client/profile/form.blade.php --}}
@extends('client.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4">Hoàn trả hàng</h2>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('client.orders.return', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="ly_do" class="form-label fw-semibold">Lý do <span class="text-danger">*</span></label>
                                <input type="text" name="ly_do" id="ly_do" class="form-control" value="{{ old('ly_do') }}">
                                @error('ly_do')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="anh" class="form-label fw-semibold">Ảnh minh chứng <span class="text-danger">*</span></label>
                                <input type="file" name="anh[]" id="anh" class="form-control" multiple>
                                @error('anh')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mo_ta" class="form-label fw-semibold">Mô tả</label>
                                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="6">{{ old('mo_ta') }}</textarea>
                                @error('mo_ta')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('client.orders.index') }}" class="btn btn-secondary">← Quay lại</a>
                                <button type="submit" class="btn btn-success">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection