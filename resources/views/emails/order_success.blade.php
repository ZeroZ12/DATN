@component('mail::message')
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
@endcomponent
