{{-- @component('mail::message')
# Xin chào {{ $receiver->ho_ten ?? $receiver->ten_dang_nhap }},

Chúng tôi xin thông báo:

**Đơn hàng #{{ $order->ma_don }}** đã được tiếp nhận thành công.

**Tổng tiền:** {{ number_format($order->tong_tien) }}₫
**Thời gian đặt:** {{ $order->created_at->format('H:i d/m/Y') }}

@component('mail::button', ['url' => $link])
{{ $buttonText }}
@endcomponent

Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ bộ phận chăm sóc khách hàng của TOPPC.

Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi!

Trân trọng,<br>
TOPPC Team
@endcomponent --}}

@component('mail::message')
@if($receiver->vai_tro=='khach_hang')
# Xin chào {{ $receiver->ho_ten ?? $receiver->ten_dang_nhap }},

Chúng tôi rất vui thông báo rằng đơn hàng của bạn đã được tiếp nhận thành công! Dưới đây là thông tin chi tiết:

**Đơn hàng #{{ $order->ma_don }}**
<br>
**Tổng tiền:** {{ number_format($order->tong_tien) }}₫
<br>
**Thời gian đặt:** {{ $order->created_at->format('H:i d/m/Y') }}

@component('mail::button', ['url' => url('/orders/' . $order->id)])
Xem chi tiết đơn hàng
@endcomponent

Nếu bạn có bất kỳ thắc mắc nào, vui lòng liên hệ bộ phận chăm sóc khách hàng qua email **support@toppc.com** hoặc hotline **1900 1234**.

Cảm ơn bạn đã tin tưởng sử dụng dịch vụ của TOPPC!

Trân trọng,
TOPPC Team

@else
# Thông báo đơn hàng mới - Admin

Kính gửi Admin,

Hệ thống vừa ghi nhận một đơn hàng mới với thông tin như sau:

**Đơn hàng #{{ $order->ma_don }}**
<br>
**Khách hàng:** {{ $receiver->ho_ten ?? $receiver->ten_dang_nhap }}
<br>
**Email khách hàng:** {{ $receiver->email }}
<br>
**Tổng tiền:** {{ number_format($order->tong_tien) }}₫
<br>
**Thời gian đặt:** {{ $order->created_at->format('H:i d/m/Y') }}

@component('mail::button', ['url' => url('/admin/don-hang/' . $order->id)])
Xử lý đơn hàng
@endcomponent

Vui lòng kiểm tra và xử lý đơn hàng trong hệ thống quản trị.

Trân trọng,
TOPPC System
@endif
@endcomponent
