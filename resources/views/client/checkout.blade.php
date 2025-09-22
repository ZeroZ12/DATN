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
                             style="width: 80px; height: 80px; object-fit: cover;"
                             onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1">{{ $item->sanPham->ten }}</h6>
                            <p class="mb-1 text-muted small">
                                @if($item->bienThe)
                                    RAM: {{ $item->bienThe->ram->dung_luong ?? 'N/A' }} |
                                    Ổ cứng: {{ $item->bienThe->oCung->loai ?? 'N/A' }} - {{ $item->bienThe->oCung->dung_luong ?? 'N/A' }}
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="quantity-control">
                                    <span class="text-muted">Số lượng: {{ $item->so_luong }}</span>
                                </div>
                                <div class="text-end">
                                    <div class="text-danger fw-bold">{{ number_format($item->gia * $item->so_luong) }}₫</div>
                                    @if($item->gia_hien_thi != ($item->gia ?? ($item->bienThe->gia ?? $item->sanPham->gia)))
                                        <small class="text-success">
                                            Giá Sale : {{ number_format($item->gia_hien_thi) }}₫
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            {{ number_format($item->gia ?? ($item->bienThe->gia ?? $item->sanPham->gia)) }}₫/sản phẩm
                                        </small>
                                    @else
                                        <small class="text-muted">
                                            {{ number_format($item->gia_hien_thi) }}₫/sản phẩm
                                        </small>
                                    @endif
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
                                <p class="mb-0 text-muted">{{ $diaChi->dia_chi_day_du }}, {{ $diaChi->phuong_xa_name }}, {{ $diaChi->tinh_thanh_pho_name }}</p>
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
                        <input class="form-check-input" type="radio" name="payment_method" id="1" value="1" @if(($tongTienSauGiam ?? 0) > 10000000) disabled @else checked @endif>
                        <label class="form-check-label" for="1">
                            <i class="fas fa-money-bill-wave me-2"></i>
                            Thanh toán khi nhận hàng (COD)
                            @if(($tongTienSauGiam ?? 0) > 10000000)
                                <span class="text-danger small">(Không khả dụng cho đơn > 10.000.000₫)</span>
                            @endif
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="payment_method" id="2" value="2" @if(($tongTienSauGiam ?? 0) > 10000000) checked @endif>
                        <label class="form-check-label" for="2">
                            <i class="fas fa-university me-2"></i>
                            Chuyển khoản ngân hàng
                        </label>
                    </div>
                    @if(($tongTienSauGiam ?? 0) > 10000000)
                    <div class="alert alert-warning small">
                        Đơn hàng trên 10.000.000₫ chỉ hỗ trợ thanh toán chuyển khoản ngân hàng.
                    </div>
                    @endif
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
            {{-- Tạm tính --}}
            <div class="d-flex justify-content-between mb-2">
                <span>Tạm tính</span>
                <span>{{ number_format($tongTienGoc) }}₫</span>
            </div>

            {{-- Giảm giá --}}
            @if($giamGia > 0)
            <div class="d-flex justify-content-between mb-2">
                <span>Giảm giá</span>
                <span class="text-success">-{{ number_format($giamGia) }}₫</span>
            </div>
            @endif

            {{-- Phí vận chuyển --}}
            <div class="d-flex justify-content-between mb-2">
                <span>Phí vận chuyển</span>
                <span>Miễn phí</span>
            </div>

            <hr>

            {{-- Tổng cộng --}}
            <div class="d-flex justify-content-between mb-3">
                <strong>Tổng cộng</strong>
                <strong class="text-danger">{{ number_format($tongTienSauGiam) }}₫</strong>
            </div>

            {{-- Mã giảm giá --}}
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

            {{-- Thông báo địa chỉ --}}
            @if(!$diaChi)
            <div class="alert alert-warning small mb-3">
                <i class="fas fa-exclamation-triangle"></i>
                Vui lòng thêm địa chỉ giao hàng trước khi đặt hàng
            </div>
            @endif

            {{-- Chính sách giao hàng --}}
            <div class="alert alert-info small mb-3">
                <i class="fas fa-truck"></i>
                Vui lòng đọc <a href="{{ route('client.policy') }}" class="text-primary text-decoration-underline">chi tiết chính sách</a> trước khi đặt hàng.
            </div>

       {{-- Checkbox đồng ý chính sách --}}
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" value="" id="agreePolicy">
    <label class="form-check-label small" for="agreePolicy">
        Tôi đã đọc và đồng ý với chính sách của shop
    </label>
</div>

{{-- Nút đặt hàng --}}
<button type="button" id="placeOrderBtn" class="btn btn-primary w-100" onclick="placeOrder()" disabled>
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
    function thanhToanVNPay() {
    fetch('{{ url('/payment/hehe') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.code === '00' && data.data) {
            // Redirect ngay sang trang thanh toán VNPay
            window.location.href = data.data;
        } else {
            alert('Có lỗi xảy ra khi tạo link thanh toán!');
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
        alert('Có lỗi xảy ra khi tạo đơn hàng!');
    });
}
function placeOrder() {
    @if(!$diaChi)
    showToast('Vui lòng thêm địa chỉ giao hàng trước khi đặt hàng!', 'error');
    return;
    @endif

    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';

    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

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
            if (data.vnpay_url) {
                window.location.href = data.vnpay_url;
            } else if (data.redirect_url) {
                window.location.href = data.redirect_url;
            } else {
                showToast('Đặt hàng thành công!', 'success');
                location.reload();
            }
        } else {
            throw new Error(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast(error.message || 'Có lỗi xảy ra khi đặt hàng!', 'error');
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


document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('agreePolicy');
    const button = document.getElementById('placeOrderBtn');
    const hasAddress = {{ $diaChi ? 'true' : 'false' }};

    // Khi checkbox thay đổi, kiểm tra
    checkbox.addEventListener('change', function() {
        if(!hasAddress){
            button.disabled = true;
        } else {
            button.disabled = !checkbox.checked;
        }
    });

    // Kiểm tra trạng thái lúc load
    button.disabled = true;
});

</script>
@endpush
