@extends('client.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Thông tin đơn hàng -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    @foreach($chiTietGioHang as $item)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <img src="{{ asset('storage/' . ($item->bienThe->anh_dai_dien ?? $item->sanPham->anh_dai_dien)) }}"
                             alt="{{ $item->sanPham->ten }}"
                             class="img-thumbnail"
                             style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1">{{ $item->sanPham->ten }}</h6>
                            <p class="mb-1 text-muted small">
                                @if($item->bienThe)
                                    RAM: {{ $item->bienThe->ram->dung_luong ?? 'N/A' }} |
                                    Ổ cứng: {{ $item->bienThe->oCung->dung_luong ?? 'N/A' }}
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="quantity-control">
                                    <span class="text-muted">Số lượng: {{ $item->so_luong }}</span>
                                </div>
                                <div class="text-end">
                                    <div class="text-danger fw-bold">{{ number_format($item->gia * $item->so_luong) }}₫</div>
                                    <small class="text-muted">{{ number_format($item->gia) }}₫/sản phẩm</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Thông tin giao hàng -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    @if($diaChi)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $diaChi->ten_nguoi_nhan }}</h6>
                                <p class="mb-1">{{ $diaChi->so_dien_thoai_nguoi_nhan }}</p>
                                <p class="mb-0 text-muted">{{ $diaChi->dia_chi_day_du }}, {{ $diaChi->phuong_xa }}, {{ $diaChi->quan_huyen }}, {{ $diaChi->tinh_thanh_pho }}</p>
                            </div>
                            <a href="{{ route('client.addresses.index') }}" class="btn btn-outline-primary btn-sm">Thay đổi</a>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="mb-3">Bạn chưa có địa chỉ giao hàng</p>
                        <a href="{{ route('client.addresses.create') }}" class="btn btn-primary">Thêm địa chỉ</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Phương thức thanh toán</h5>
                </div>
                <div class="card-body">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="1" value="1" checked>
                        <label class="form-check-label" for="1">
                            <i class="fas fa-money-bill-wave me-2"></i>
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="2" value="2">
                        <label class="form-check-label" for="2">
                            <i class="fas fa-university me-2"></i>
                            Chuyển khoản ngân hàng
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="3" value="3">
                        <label class="form-check-label" for="3">
                            <i class="fas fa-wallet me-2"></i>
                            Ví MoMo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="4" value="4">
                        <label class="form-check-label" for="4">
                            <i class="fas fa-credit-card me-2"></i>
                            Thẻ tín dụng
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tổng đơn hàng -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Tổng đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span>{{ number_format($tongTienGoc) }}₫</span>
                    </div>
                    @if($giamGia > 0)
                    <div class="d-flex justify-content-between mb-2">
                        <span>Giảm giá</span>
                        <span class="text-success">-{{ number_format($giamGia) }}₫</span>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span>Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Tổng cộng</strong>
                        <strong class="text-danger">{{ number_format($tongTienSauGiam) }}₫</strong>
                    </div>
                    @if($giamGia > 0)
                    <div class="alert alert-success small mb-3">
                        <i class="fas fa-check-circle"></i>
                        Đã áp dụng mã giảm giá: <strong>{{ $gioHang->maGiamGia->ma }}</strong>
                        @if($gioHang->maGiamGia->loai == 'phan_tram')
                            (Giảm {{ $gioHang->maGiamGia->gia_tri }}%)
                        @else
                            (Giảm {{ number_format($gioHang->maGiamGia->gia_tri) }}₫)
                        @endif
                    </div>
                    @endif
                    @if(!$diaChi)
                    <div class="alert alert-warning small mb-3">
                        <i class="fas fa-exclamation-triangle"></i>
                        Vui lòng thêm địa chỉ giao hàng trước khi đặt hàng
                    </div>
                    @endif
                    <button type="button" class="btn btn-primary w-100" onclick="placeOrder()" @if(!$diaChi) disabled @endif>
                        @if(!$diaChi) Vui lòng thêm địa chỉ @else Đặt hàng @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    .card-header {
        border-bottom: 1px solid #eee;
        padding: 1rem;
    }
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }
</style>
@endpush

@push('js')
<script>
function placeOrder() {
    // Kiểm tra địa chỉ
    @if(!$diaChi)
    showToast('Vui lòng thêm địa chỉ giao hàng trước khi đặt hàng!', 'error');
    return;
    @endif

    // Hiển thị loading
    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';

    // Lấy phương thức thanh toán
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

    // Gửi request đặt hàng
    fetch('{{ route("client.cart.place-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            payment_method: paymentMethod
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorData => {
                throw new Error(errorData.message || 'Có lỗi xảy ra khi đặt hàng');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Chuyển hướng đến trang thanh toán
            window.location.href = data.redirect_url;
        } else {
            throw new Error(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Hiển thị lỗi
        showToast(error.message || 'Có lỗi xảy ra khi đặt hàng!', 'error');

        // Reset button
        button.disabled = false;
        button.innerHTML = originalText;
    });
}

function showToast(message, type = 'success') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;

    // Add toast styles if not exists
    if (!document.querySelector('#toast-styles')) {
        const style = document.createElement('style');
        style.id = 'toast-styles';
        style.textContent = `
            .toast {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 9999;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                border-left: 4px solid #28a745;
            }
            .toast.toast-error {
                border-left-color: #dc3545;
            }
            .toast-content {
                padding: 15px 20px;
                display: flex;
                align-items: center;
                gap: 10px;
                color: #333;
                font-size: 14px;
            }
            .toast.show {
                transform: translateX(0);
            }
        `;
        document.head.appendChild(style);
    }

    // Add to page
    document.body.appendChild(toast);

    // Show toast
    setTimeout(() => toast.classList.add('show'), 100);

    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
@endpush
