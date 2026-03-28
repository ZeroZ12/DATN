@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Card doanh thu --}}
    <div class="row mb-4">
        @foreach([
            ['title'=>'Doanh thu hôm nay','amount'=>$doanhThuHomNay,'count'=>$soDonHomNay,'color'=>'primary'],
            ['title'=>'Doanh thu tháng này','amount'=>$doanhThuThang,'count'=>$soDonThang,'color'=>'success'],
            ['title'=>'Doanh thu năm nay','amount'=>$doanhThuNam,'count'=>$soDonNam,'color'=>'warning'],
        ] as $card)
        <div class="col-md-4 mb-3">
            <div class="card bg-{{$card['color']}} text-white text-center shadow-sm">
                <div class="card-body">
                    <h5>{{$card['title']}}</h5>
                    <h3>{{ number_format($card['amount']) }}₫</h3>
                    <p>{{$card['count']}} đơn hàng</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Lọc chart --}}
    <div class="row mb-3 align-items-end">
        <div class="col-md-3 mb-2">
            <label>Loại lọc</label>
            <select id="filterType" class="form-select">
                <option value="ngay" {{ $type=='ngay'?'selected':'' }}>Theo ngày</option>
                <option value="thang" {{ $type=='thang'?'selected':'' }}>Theo tháng</option>
                <option value="nam" {{ $type=='nam'?'selected':'' }}>Theo năm</option>
                <option value="range" {{ $type=='range'?'selected':'' }}>Khoảng ngày</option>
            </select>
        </div>
        <div class="col-md-4 mb-2" id="filterInput"></div>
        <div class="col-md-2 mb-2">
            <button id="applyFilter" class="btn btn-primary w-100">Áp dụng</button>
        </div>
    </div>

   {{-- Card tổng doanh thu theo filter --}}
@if(isset($totalDoanhThuFilter))
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-info shadow-sm" role="alert">
                @if($type=='ngay')
                    Doanh thu ngày <strong>{{ $labelFilter }}</strong>
                @elseif($type=='thang')
                    Doanh thu tháng <strong>{{ $labelFilter }}</strong>
                @elseif($type=='nam')
                    Doanh thu năm <strong>{{ $labelFilter }}</strong>
                @elseif($type=='range')
                    Doanh thu từ <strong>{{ $labelFilter['from'] }}</strong> đến <strong>{{ $labelFilter['to'] }}</strong>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card bg-info text-white text-center shadow-sm">
                <div class="card-body">
                    <h5>Tổng doanh thu</h5>
                    <h3>{{ number_format($totalDoanhThuFilter) }}₫</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card bg-secondary text-white text-center shadow-sm">
                <div class="card-body">
                    <h5>Tổng đơn hàng</h5>
                    <h3>{{ $totalDonHangFilter }}</h3>
                </div>
            </div>
        </div>
    </div>
@endif


    {{-- Biểu đồ --}}
    <div class="row">
        <div class="col-12">
            <div style="height:400px;">
                <canvas id="doanhThuChart"></canvas>
            </div>
        </div>
    </div>
    {{-- Danh sách đơn hàng --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách đơn hàng</h5>
                <small>
                    @if($type=='ngay')
                        Thời gian: <strong>{{ $labelFilter }}</strong>
                    @elseif($type=='thang')
                        Tháng: <strong>{{ $labelFilter }}</strong>
                    @elseif($type=='nam')
                        Năm: <strong>{{ $labelFilter }}</strong>
                    @elseif($type=='range')
                        Từ <strong>{{ $labelFilter['from'] }}</strong> đến <strong>{{ $labelFilter['to'] }}</strong>
                    @else
                        10 đơn hàng gần nhất
                    @endif
                </small>
            </div>
            <div class="card-body p-0">
                <div style="max-height:400px; overflow-y:auto;">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày cập nhật</th>
                            </tr>
                        </thead>
                      <tbody id="ordersTableBody">
     @forelse($orders as $index => $order)
        <tr style="cursor:pointer;" onclick="window.location='{{ route('admin.don-hang.show', $order->id) }}'">
            <td>{{ $index + 1 }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->ma_don }}</td>
            <td>{{ $order->khachHang->ho_ten ?? 'Khách vãng lai' }}</td>
            <td>{{ number_format($order->tong_tien) }}₫</td>
            <td>{{ App\Models\DonHang::getTenTrangThai($order->trang_thai) }}</td>
            <td>{{ $order->updated_at->format('d/m/Y H:i') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center text-muted">
                Không có đơn hàng nào
            </td>
        </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    {{-- Cột 1: Sản phẩm bán chạy --}}
    <div class="col-md-6 mb-3 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header fw-bold">Sản Phẩm Bán Chạy</div>
            <div class="card-body d-flex flex-column">
                @forelse ($sanPhamBanChay as $sanPham)
                    <div class="mb-3 d-flex flex-column">
                        <div class="d-flex align-items-start mb-2">
                            <img src="{{ asset('storage/'.$sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten }}" width="60" class="me-2 flex-shrink-0">
                            <span class="fw-bold text-dark flex-grow-1">{{ $sanPham->ten }}</span>
                        </div>
                        <div class="small text-muted">Đã bán: {{ $sanPham->luot_mua }}</div>
                        <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn btn-sm btn-primary mt-2 align-self-start">Xem sản phẩm</a>
                    </div>
                    @if (!$loop->last) <hr> @endif
                @empty
                    <p class="text-muted">Chưa có sản phẩm nào</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Cột 2: Sản phẩm xem nhiều --}}
    <div class="col-md-6 mb-3 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header fw-bold">Sản Phẩm Xem Nhiều</div>
            <div class="card-body d-flex flex-column">
                @forelse ($sanPhamXemNhieu as $sanPham)
                    <div class="mb-3 d-flex flex-column">
                        <div class="d-flex align-items-start mb-2">
                            <img src="{{ asset('storage/'.$sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten }}" width="60" class="me-2 flex-shrink-0">
                            <span class="fw-bold text-dark flex-grow-1">{{ $sanPham->ten }}</span>
                        </div>
                        <div class="small text-muted">Lượt xem: {{ $sanPham->luot_xem }}</div>
                        <a href="{{ route('sanpham.show', $sanPham->id) }}" class="btn btn-sm btn-primary mt-2 align-self-start">Xem sản phẩm</a>
                    </div>
                    @if (!$loop->last) <hr> @endif
                @empty
                    <p class="text-muted">Chưa có sản phẩm nào</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header fw-bold">
        📉 Sản phẩm sắp hết hàng
        <span class="text-muted ms-2">(Tổng: {{ $sanPhamSapHetHang->count() }} sản phẩm)</span>
    </div>

    <div class="card-body">
        <ul class="list-group">
            @forelse ($sanPhamSapHetHang as $bienThe)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <div class="flex-grow-1 me-2">
                        <div><strong>{{ $bienThe->sanPham->ten ?? '---' }}</strong></div>
                        <div class="small text-muted">
                            Mã biến thể: {{ $bienThe->ma_bien_the ?? '---' }} |
                            @if ($bienThe->ram) RAM: {{ $bienThe->ram->dung_luong }} | @endif
                            @if ($bienThe->oCung) Ổ cứng: {{ $bienThe->oCung->loai }} - {{ $bienThe->oCung->dung_luong }} | @endif
                            <span class="text-danger">Còn lại: <strong>{{ $bienThe->ton_kho }}</strong> cái</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.sanpham.bienthe.edit', [$bienThe->id_product, $bienThe->id]) }}" class="btn btn-sm btn-outline-warning mt-2 mt-md-0">
                        Quản lý
                    </a>
                </li>
            @empty
                <li class="list-group-item text-muted">Không có sản phẩm nào gần hết hàng</li>
            @endforelse
        </ul>
    </div>
</div>



</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const filterType = document.getElementById('filterType');
const filterInput = document.getElementById('filterInput');

// Render input theo loại filter
function renderFilterInput(type){
    let html = '';
    if(type === 'ngay') html = `<input type="date" id="filterDay" class="form-control">`;
    else if(type === 'thang') html = `<input type="month" id="filterMonth" class="form-control">`;
    else if(type === 'nam') html = `<input type="number" id="filterYear" min="2000" max="2100" class="form-control">`;
    else if(type === 'range') html = `
        <input type="date" id="fromDate" class="form-control mb-1" placeholder="Từ ngày">
        <input type="date" id="toDate" class="form-control" placeholder="Đến ngày">
    `;
    filterInput.innerHTML = html;
}
filterType.addEventListener('change', ()=>renderFilterInput(filterType.value));
renderFilterInput(filterType.value);

// Áp dụng filter
document.getElementById('applyFilter').addEventListener('click', ()=>{
    const type = filterType.value;
    const params = new URLSearchParams();
    params.set('type', type);

    if(type==='ngay'){
        const day=document.getElementById('filterDay').value;
        if(day) params.set('day',day);
    } else if(type==='thang'){
        const month=document.getElementById('filterMonth').value;
        if(month) params.set('month',month);
    } else if(type==='nam'){
        const year=document.getElementById('filterYear').value;
        if(year) params.set('year',year);
    } else if(type==='range'){
        const from=document.getElementById('fromDate').value;
        const to=document.getElementById('toDate').value;
        if(from && to){ params.set('from',from); params.set('to',to);}
    }
    window.location.href = '?' + params.toString();
});

// Chart.js
const ctx = document.getElementById('doanhThuChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(54,162,235,0.4)');
gradient.addColorStop(1, 'rgba(54,162,235,0)');

new Chart(ctx,{
    type:'line',
    data:{
        labels:@json($labels),
        datasets:[{
            label:'Doanh thu (VNĐ)',
            data:@json($chartData),
            backgroundColor: gradient,
            borderColor:'rgba(54,162,235,1)',
            borderWidth:2,
            fill:true,
            tension:0.4,
            pointRadius:5,
            pointBackgroundColor:'rgba(54,162,235,1)',
            pointHoverRadius:7,
            pointHoverBackgroundColor:'rgba(255,99,132,1)',
            pointHoverBorderColor:'#fff',
            pointBorderWidth:1
        }]
    },
    options:{
        responsive:true,
        maintainAspectRatio:false,
        plugins:{
            legend:{
                labels:{ font:{size:13, weight:'500'} }
            },
            tooltip:{
                mode:'index',
                intersect:false,
                padding:10,
                backgroundColor:'rgba(0,0,0,0.7)',
                titleFont:{size:14, weight:'600'},
                bodyFont:{size:13},
                callbacks:{
                    label: function(ctx){
                        return new Intl.NumberFormat('vi-VN').format(ctx.raw)+' VNĐ';
                    }
                }
            }
        },
        scales:{
            y:{
                beginAtZero:true,
                ticks:{
                    font:{size:12},
                    callback: val => new Intl.NumberFormat('vi-VN').format(val)+' đ'
                },
                grid:{ color:'rgba(0,0,0,0.05)', drawBorder:false }
            },
            x:{ ticks:{ font:{size:12} }, grid:{ display:false } }
        }
    }
});

// Hàm load orders qua AJAX
function loadOrdersAjax(params){
    fetch("{{ route('admin.thongke') }}?"+params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
    .then(res => res.json())
    .then(data => {
        // Cập nhật table
        const tbody = document.getElementById('ordersTableBody');
        tbody.innerHTML = '';
        data.orders.forEach((o,index)=>{
            tbody.innerHTML += `<tr>
                <td>${index+1}</td>
                <td>${o.ma_don}</td>
                <td>${o.ten_khach}</td>
                <td>${new Intl.NumberFormat('vi-VN').format(o.tong_tien)}₫</td>
                <td>${o.trang_thai}</td>
                <td>${o.updated_at}</td>
            </tr>`;
        });

        // Cập nhật chart
        doanhThuChart.data.labels = data.labels;
        doanhThuChart.data.datasets[0].data = data.chartData;
        doanhThuChart.update();
    });
}

// Override nút Áp dụng để dùng AJAX
document.getElementById('applyFilter').addEventListener('click', ()=>{
    const type = filterType.value;
    const params = new URLSearchParams();
    params.set('type', type);

    if(type==='ngay'){
        const day=document.getElementById('filterDay').value;
        if(day) params.set('day',day);
    } else if(type==='thang'){
        const month=document.getElementById('filterMonth').value;
        if(month) params.set('month',month);
    } else if(type==='nam'){
        const year=document.getElementById('filterYear').value;
        if(year) params.set('year',year);
    } else if(type==='range'){
        const from=document.getElementById('fromDate').value;
        const to=document.getElementById('toDate').value;
        if(from && to){ params.set('from',from); params.set('to',to);}
    }
    loadOrdersAjax(params);
});
</script>
@endpush


