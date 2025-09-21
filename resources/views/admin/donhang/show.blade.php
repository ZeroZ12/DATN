@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-bold">Chi tiết đơn hàng: #{{ $donHang->ma_don }}</h2>

        {{-- Thông tin đơn hàng --}}
        <div class="card mb-4">
            <div class="card-header bg-light fw-bold">Thông tin đơn hàng</div>
            <div class="card-body">
                <div class="row gy-2">
                    <div class="col-md-6"><strong>Khách hàng:</strong> {{ $donHang->user->ho_ten ?? '---' }}</div>
                    <div class="col-md-6"><strong>Địa chỉ nhận hàng:</strong>
                        {{ $donHang->diaChiNguoiDung->dia_chi_day_du ?? '---' }},
                        {{ $donHang->diaChiNguoiDung->phuong_xa_name ?? '---' }},
                        {{ $donHang->diaChiNguoiDung->tinh_thanh_pho_name ?? '---' }}
                    </div>
                    <div class="col-md-6"><strong>Phương thức thanh toán:</strong>
                        {{ $donHang->phuongThucThanhToan->ten ?? '---' }}</div>
                    <div class="col-md-6"><strong>Mã giảm giá:</strong> {{ $donHang->maGiamGia->ma ?? 'Không có.' }}</div>
                    <div class="col-md-6"><strong>Tổng tiền gốc:</strong> {{ number_format($donHang->tong_tien_goc, 0) }}đ
                    </div>
                    <div class="col-md-6"><strong>Giảm giá:</strong> {{ number_format($donHang->giam_gia, 0) }}đ</div>
                    <div class="col-md-6"><strong>Tổng tiền thanh toán:</strong>
                        <span class="text-danger fw-bold">{{ number_format($donHang->tong_tien, 0) }}đ</span>
                    </div>
                    <div class="col-md-6"><strong>Trạng thái:</strong>
                        <span class="badge status-{{ $donHang->trang_thai }}">
                            {{ App\Models\DonHang::getTenTrangThai($donHang->trang_thai) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Danh sách sản phẩm --}}
        <div class="card">
            <div class="card-header bg-light fw-bold">Danh sách sản phẩm</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr style="text-align: center;">
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donHang->chiTietDonHangs as $ct)
                                <tr style="text-align: center;">
                                    <td>
                                        @php
                                            $anh = $ct->bienTheSanPham
                                                ? $ct->bienTheSanPham->sanPham?->anh_dai_dien
                                                : $ct->sanPham?->anh_dai_dien;
                                        @endphp
                                        <img src="{{ $anh ? asset('storage/' . $anh) : 'https://via.placeholder.com/60' }}"
                                            alt="Ảnh" width="60" height="60" class="rounded border">
                                    </td>
                                    <td class="text-start">
                                        {{ $ct->ten_hien_thi }}
                                        <br>
                                        <small class="text-muted">
                                            @if ($ct->bienTheSanPham)
                                                Mã biến thể: {{ $ct->bienTheSanPham->ma_bien_the ?? '---' }} <br>
                                                RAM: {{ $ct->bienTheSanPham->ram->dung_luong ?? '---' }} |
                                                Ổ cứng: {{ $ct->bienTheSanPham->oCung->loai ?? '---' }} - {{ $ct->bienTheSanPham->oCung->dung_luong ?? '---' }}
                                            @else
                                                Thương hiệu: {{ $ct->sanPham->thuongHieu->ten ?? '---' }}
                                            @endif
                                        </small>
                                    </td>
                                    <td class="text-center">{{ $ct->so_luong }}</td>
                                    <td>{{ number_format($ct->don_gia, 0) }}đ</td>
                                    <td>{{ number_format($ct->so_luong * $ct->don_gia, 0) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Thông tin hoàn trả (nếu có) --}}
        @if(in_array($donHang->trang_thai, ['yeu_cau_hoan_tra','da_phe_duyet','dang_tra_hang','shop_da_nhan_hang']) || $donHang->tu_choi_hoan==1)
            <div class="card mb-4 mt-4">
                <div class="card-header bg-warning fw-bold">💰 Thông tin hoàn trả</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <strong>Trạng thái hoàn trả:</strong>
                            @if($donHang->tu_choi_hoan == 1)
                                <span class="badge bg-danger">❌ Yêu cầu bị từ chối</span>
                            @elseif($donHang->trang_thai == 'da_huy')
                                <span class="badge bg-success">✅ Hoàn tiền thành công</span>
                            @else
                                <span class="badge bg-dark">⏳ Đang xử lý</span>
                            @endif
                        </div>
                        <div class="col-md-6"><strong>Lý do:</strong> {{ $donHang->ly_do ?? '---' }}</div>

                        @if($donHang->phuong_thuc_hoan_tien)
                            <div class="col-md-6"><strong>Phương thức:</strong>
                                {{ $donHang->phuong_thuc_hoan_tien == 'momo' ? 'Momo' : 'Chuyển khoản ngân hàng' }}
                            </div>
                            @if($donHang->phuong_thuc_hoan_tien !== 'momo')
                                <div class="col-md-6"><strong>Ngân hàng:</strong> {{ $donHang->ten_ngan_hang ?? '---' }}</div>
                            @endif
                            <div class="col-md-6"><strong>Số tài khoản/Momo:</strong> {{ $donHang->so_tai_khoan ?? '---' }}</div>
                        @endif
                    </div>


  {{-- Người & thời gian hoàn tiền --}}
<div class="col-md-6">
    <strong>Người hoàn tiền:</strong>
    @if($donHang->id_nguoi_hoan_tien)
        {{ $donHang->user?->ho_ten ?? '---' }}
    @else
        <span class="text-muted">Chưa hoàn tiền</span>
    @endif
</div>

<div class="col-md-6">
    <strong>Thời gian hoàn tiền:</strong>
    @if($donHang->thoi_gian_hoan_tien)
        {{ \Carbon\Carbon::parse($donHang->thoi_gian_hoan_tien)->format('d/m/Y H:i') }}
    @else
        <span class="text-muted">Chưa hoàn tiền</span>
    @endif
</div>

{{-- Thời gian nhận hàng --}}
<div class="col-md-6">
    <strong>Thời gian nhận hàng:</strong>
    @if($donHang->thoi_gian_shop_nhan)
        {{ \Carbon\Carbon::parse($donHang->thoi_gian_shop_nhan)->format('d/m/Y H:i') }}
    @else
        <span class="text-muted">Chưa nhận hàng</span>
    @endif
</div>



                    <hr>

                    {{-- Ảnh minh chứng --}}
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Ảnh minh chứng (Người dùng):</strong>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($donHang->anhMinhChungs->where('loai','nguoi_dung') as $anh)
                                    <a href="{{ asset('storage/'.$anh->duong_dan) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$anh->duong_dan) }}" width="100" class="rounded border">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Ảnh minh chứng (Shop):</strong>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($donHang->anhMinhChungs->where('loai','admin') as $anh)
                                    <a href="{{ asset('storage/'.$anh->duong_dan) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$anh->duong_dan) }}" width="100" class="rounded border">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Nút hành động --}}
        <div class="d-flex flex-wrap gap-2 mt-3">
            {{-- Quay lại --}}
            <a href="{{ route('admin.don-hang.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>

            {{-- Các nút theo trạng thái --}}
            @if ($donHang->trang_thai === 'cho_xac_nhan')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="da_xac_nhan">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-success">Xác nhận</button>
                </form>
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="da_huy">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-danger">Hủy</button>
                </form>
            @elseif ($donHang->trang_thai === 'da_xac_nhan')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="chuan_bi_hang">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-success">Chuẩn bị hàng</button>
                </form>
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="da_huy">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-danger">Hủy</button>
                </form>
            @elseif ($donHang->trang_thai === 'chuan_bi_hang')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="dang_giao_hang">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-success">Giao hàng</button>
                </form>
            @elseif ($donHang->trang_thai === 'dang_giao_hang')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="giao_thanh_cong">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-success">Đã giao</button>
                </form>
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="giao_that_bai">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-danger">Thất bại</button>
                </form>
            @elseif ($donHang->trang_thai === 'giao_that_bai')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="da_huy">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-danger">Hủy đơn</button>
                </form>
            @elseif ($donHang->trang_thai === 'yeu_cau_hoan_tra')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="da_phe_duyet">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-success">Phê duyệt</button>
                </form>
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="hoan_thanh">
                    <input type="hidden" name="tu_choi_hoan" value="1">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-danger">Từ chối</button>
                </form>
            @elseif ($donHang->trang_thai === 'dang_tra_hang')
                <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}">
                    @csrf
                    <input type="hidden" name="trang_thai" value="shop_da_nhan_hang">
                    <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">
                    <button class="btn btn-sm btn-info">Shop đã nhận hàng</button>
                </form>
           @elseif ($donHang->trang_thai === 'shop_da_nhan_hang')
    <button type="button" class="btn btn-sm btn-success"
        data-bs-toggle="modal"
        data-bs-target="#modal-hoan-tien-{{ $donHang->id }}">
        <i class="bi bi-cash-stack"></i> Hoàn tiền
    </button>
@endif

{{-- Modal Hoàn tiền --}}
<div class="modal fade" id="modal-hoan-tien-{{ $donHang->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $donHang->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form method="POST" action="{{ route('admin.don-hang.cap-nhat-trang-thai', $donHang->id) }}"
            enctype="multipart/form-data">
        @csrf
        {{-- Hidden input: Cập nhật trạng thái --}}
        <input type="hidden" name="trang_thai" value="da_hoan_tien">
        <input type="hidden" name="trang_thai_hien_tai" value="{{ $donHang->trang_thai }}">

        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel{{ $donHang->id }}">
            Xác nhận đã hoàn tiền
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="anh_minh_chung_{{ $donHang->id }}" class="form-label">
              Ảnh bill minh chứng hoàn tiền
            </label>
            <input type="file" id="anh_minh_chung_{{ $donHang->id }}"
                   name="anh_minh_chung[]"
                   multiple
                   accept="image/*"
                   class="form-control" required>
            <small class="text-muted">Có thể chọn nhiều ảnh (chuyển khoản, ví điện tử, biên lai...)</small>
          </div>
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
    </div>
@endsection

@push('css')
<style>
    .badge {
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 6px;
    font-weight: 500;
    color: #fff;
}

/* Trạng thái hoàn thành & giao thành công → Xanh lá */
.status-hoan_thanh,
.status-giao_thanh_cong {
    background-color: #28a745; /* xanh lá */
}

/* Trạng thái đã hủy → Đỏ */
.status-da_huy,
.status-giao_that_bai{
    background-color: #dc3545; /* đỏ */
}

/* Tất cả trạng thái còn lại → Xám */
.status-cho_xac_nhan,
.status-cho_thanh_toan,
.status-da_xac_nhan,
.status-chuan_bi_hang,
.status-dang_giao_hang,
.status-yeu_cau_hoan_tra,
.status-cho_phe_duyet,
.status-da_phe_duyet,
.status-dang_tra_hang,
.status-shop_da_nhan_hang,
.status-da_hoan_tien {
    background-color: #6c757d; /* xám */
}

</style>
@endpush
