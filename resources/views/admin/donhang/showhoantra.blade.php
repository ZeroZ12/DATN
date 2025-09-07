@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 mt-2 fw-bold">Chi tiết yêu cầu hoàn trả</h2>

        {{-- Grid 2 cột: Thông tin đơn hàng + Tài khoản --}}
        <div class="row g-4 mb-4">
            {{-- Thông tin đơn hàng --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Thông tin đơn hàng
                    </div>
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong>
                            <a href="{{ route('admin.don-hang.show', $hoanTra->donHang->id) }}">
                                {{ $hoanTra->donHang->ma_don }}
                            </a>
                        </p>
                        <p><strong>Phương thức thanh toán:</strong>
                            {{ $hoanTra->donHang->phuongThucThanhToan->ten ?? '---' }}</p>
                        <p><strong>Khách hàng:</strong> {{ $hoanTra->donHang->user->ho_ten ?? '---' }}</p>
                        <p><strong>SĐT:</strong> {{ $hoanTra->sdt_lien_he }}</p>
                        <p><strong>Tổng tiền:</strong> <span
                                style="color: red">{{ number_format($hoanTra->donHang->tong_tien, 0) }}đ </span></p>
                        <p><strong>Địa chỉ giao hàng:</strong>{{ $hoanTra->donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }},
                            {{ $hoanTra->donHang->diaChiNguoiDung->phuong_xa_name ?? '---' }},
                            {{ $hoanTra->donHang->diaChiNguoiDung->tinh_thanh_pho_name ?? '---' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tài khoản nhận hoàn tiền --}}
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light fw-bold">
                        Tài khoản nhận hoàn tiền
                    </div>
                    <div class="card-body">
                        @php
                            $tenPhuongThuc = match ($hoanTra->phuong_thuc_hoan_tien) {
                                'momo' => 'Ví điện tử Momo',
                                'bank_transfer' => 'Chuyển khoản ngân hàng',
                                default => 'Không xác định',
                            };
                        @endphp
                        <p><strong>Phương thức:</strong> {{ $tenPhuongThuc }}</p>

                        @if ($hoanTra->phuong_thuc_hoan_tien === 'bank_transfer')
                            <p><strong>Ngân hàng:</strong><span style="color:blue">{{ $hoanTra->ten_ngan_hang ?? '---' }}</span>
                            </p>
                        @endif

                        <p><strong>Số TK / SĐT Momo:</strong> <span style="color: blue">{{ $hoanTra->so_tai_khoan }}</span>
                        </p>
                        <p><strong>Chủ tài khoản:</strong> {{ $hoanTra->ten_chu_tai_khoan }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trạng thái + lý do hoàn trả --}}
       <div class="card shadow-sm mb-4">
    <div class="card-header bg-light fw-bold">
        Thông tin hoàn trả
    </div>
    <div class="card-body">
        @if ($hoanTra->trang_thai !== 'cho_phe_duyet')
    <p><strong>Người xác nhận: </strong>{{ $adminHoanTra }}</p>
@endif

        <p><strong>Thời gian yêu cầu hoàn trả:</strong> {{ date('H:i d/m/Y', strtotime($hoanTra->created_at)) }}</p>
        <p><strong>Mã hoàn trả:</strong> {{ $hoanTra->ma_hoan_tra }}</p>
        <p><strong>Trạng thái:</strong>
            <span class="badge status-{{ $hoanTra->trang_thai }}">
                {{ \App\Models\YeuCauHoanTra::getTenTrangThai($hoanTra->trang_thai) }}
            </span>
        </p>
        <p><strong>Lý do hoàn trả: </strong>{{ $hoanTra->ly_do }}</p>

        @if ($hoanTra->thoi_gian_nhan_hang)
    <p><strong>Thời gian nhận hàng:</strong>
        {{ \Carbon\Carbon::parse($hoanTra->thoi_gian_nhan_hang)->format('H:i d/m/Y') }}
    </p>
@elseif ($hoanTra->trang_thai === 'dang_van_chuyen_tra_hang')
    <p><strong>Thời gian nhận hàng:</strong> <span class="text-danger">Chưa nhận được hàng</span></p>
@endif


       {{-- Thời gian hoàn tiền --}}
@if ($hoanTra->thoi_gian_hoan_tien)
    <p><strong>Thời gian hoàn tiền:</strong>
        {{ \Carbon\Carbon::parse($hoanTra->thoi_gian_hoan_tien)->format('H:i d/m/Y') }}
    </p>
@elseif ($hoanTra->trang_thai === 'da_nhan_hang' || $hoanTra->trang_thai === 'da_hoan_tien')
    <p><strong>Thời gian hoàn tiền:</strong> <span class="text-danger">Chưa hoàn tiền</span></p>
@endif

{{-- Người hoàn tiền --}}
@if ($hoanTra->nguoiHoanTien)
    <p><strong>Người hoàn tiền:</strong> {{ $hoanTra->nguoiHoanTien->ho_ten ?? '---' }}</p>
@elseif ($hoanTra->trang_thai === 'da_nhan_hang' || $hoanTra->trang_thai === 'da_hoan_tien')
    <p><strong>Người hoàn tiền:</strong> <span class="text-danger">Chưa hoàn tiền</span></p>
@endif

    </div>
</div>


        {{-- Danh sách sản phẩm --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Sản phẩm trong đơn hàng
            </div>
            <div class="card-body">
                @foreach ($hoanTra->donHang->chiTietDonHangs as $item)
                    <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                        <img src="{{ asset('storage/' . $item->sanPham->anh_dai_dien) }}" width="60" height="60"
                            class="rounded me-3" style="object-fit: cover;">
                        <div class="flex-grow-1">
                            <div><strong>{{ $item->sanPham->ten ?? '---' }}</strong></div>
                            <div class="text-muted small">Biến thể: {{ $item->bienTheSanPham->ma_bien_the ?? '---' }}</div>
                        </div>
                        <div class="text-end" style="white-space: nowrap;">
                            <div>SL: x{{ $item->so_luong }}</div>
                            <div>Giá: {{ number_format($item->don_gia, 0) }}đ</div>
                        </div>
                    </div>
                @endforeach
            </div>
 {{-- Ảnh minh chứng --}}
 @php
    $anhNguoiDung = $hoanTra->anhMinhChung->where('loai', 'nguoi_dung');
    $anhAdmin = $hoanTra->anhMinhChung->where('loai', 'admin');
@endphp

@if ($anhNguoiDung->count())
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">
            Ảnh minh chứng người dùng cung cấp
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($anhNguoiDung as $index => $anh)
                    <div class="col-md-3 mb-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAnhNguoiDung{{ $index }}">
                            <img src="{{ asset($anh->duong_dan) }}" class="img-fluid border rounded"
                                 style="object-fit: contain; aspect-ratio: 1/1; width: 100%; background-color: #f8f9fa;">
                        </a>
                    </div>

                    <div class="modal fade" id="modalAnhNguoiDung{{ $index }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ảnh minh chứng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset($anh->duong_dan) }}" class="img-fluid rounded" style="max-height: 80vh;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if ($anhAdmin->count())
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">
            Ảnh minh chứng hoàn tiền
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($anhAdmin as $index => $anh)
                    <div class="col-md-3 mb-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalAnhAdmin{{ $index }}">
                            <img src="{{ asset('storage/' . $anh->duong_dan) }}" class="img-fluid border rounded"
                                 style="object-fit: contain; aspect-ratio: 1/1; width: 100%; background-color: #f1f3f5;">
                        </a>
                    </div>

                    <div class="modal fade" id="modalAnhAdmin{{ $index }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ảnh minh chứng hoàn tiền</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $anh->duong_dan) }}" class="img-fluid rounded" style="max-height: 80vh;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif



        </div>

        <a href="{{ route('admin.hoan-tra.index')}}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
        @php
    $trangThai = $hoanTra->trang_thai;
@endphp

@if ($trangThai === 'cho_phe_duyet')
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="da_phe_duyet">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-success">Phê duyệt</button>
    </form>
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="tu_choi">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-danger">Từ chối</button>
    </form>



@elseif ($trangThai === 'dang_van_chuyen_tra_hang')
    <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}" class="d-inline">
        @csrf
        <input type="hidden" name="trang_thai" value="da_nhan_hang">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">
        <button class="btn btn-sm btn-info">Đã nhận hàng</button>
    </form>


@elseif ($trangThai === 'da_nhan_hang')
    <button type="button" class="btn btn-sm btn-success"
        data-bs-toggle="modal"
        data-bs-target="#modal-hoan-tien-{{ $hoanTra->id }}">
        Hoàn tiền
    </button>
@endif

<div class="modal fade" id="modal-hoan-tien-{{ $hoanTra->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $hoanTra->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form method="POST" action="{{ route('admin.hoan-tra.cap-nhat-trang-thai', $hoanTra->id) }}"
            enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="trang_thai" value="da_hoan_tien">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $trangThai }}">

        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel{{ $hoanTra->id }}">Xác nhận đã hoàn tiền</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <label for="anh_minh_chung">Ảnh bill minh chứng:</label>
          <input type="file" name="anh_minh_chung[]" multiple accept="image/*" class="form-control" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Xác nhận hoàn tiền</button>
        </div>
      </form>

    </div>
  </div>
</div>


    </div>
@endsection

@push('css')
    <style>
        .status-cho_phe_duyet {
            background-color: #ffc107;
        }

        .status-da_phe_duyet {
            background-color: #0d6efd;
        }

        .status-tu_choi {
            background-color: #dc3545;
        }

        .status-dang_van_chuyen_tra_hang {
            background-color: #6c757d;
        }

        .status-da_nhan_hang {
            background-color: #20c997;
        }

        .status-da_hoan_tien {
            background-color: #198754;
        }

        .status-chua_hoan_tra {
            background-color: #adb5bd;
        }

        .badge {
            color: white !important;
            font-size: 0.85rem;
            padding: 0.45em 0.75em;
        }
    </style>
@endpush
