{{-- resources/views/client/policy.blade.php --}}
@extends('client.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Chính sách & Quy định</h2>

                    {{-- 1. Chính sách bảo mật --}}
                    <section class="mb-4">
                        <h4>1. Chính sách bảo mật</h4>
                        <p>Chúng tôi cam kết bảo mật thông tin cá nhân của khách hàng. Thông tin đăng ký và mua hàng sẽ chỉ được sử dụng để quản lý đơn hàng và hỗ trợ dịch vụ khách hàng.</p>
                    </section>

                    {{-- 2. Chính sách đổi trả --}}
                    <section class="mb-4">
                        <h4>2. Chính sách đổi trả</h4>
                        <p>Chúng tôi chỉ chấp nhận đổi trả hoặc hoàn tiền đối với sản phẩm <strong>bị lỗi, trục trặc từ nhà sản xuất</strong>.</p>

                        <h5>Điều kiện đổi trả:</h5>
                        <ul>
                            <li>Sản phẩm bị lỗi hoặc trục trặc do nhà sản xuất.</li>
                            <li>Sản phẩm còn nguyên vẹn, không nứt vỡ, không biến dạng do ngoại lực.</li>
                            <li>Không có dấu hiệu bị ẩm, vô nước gây chạm mạch.</li>
                            <li>Thông tin S/N và tem bảo hành còn nguyên vẹn.</li>
                            <li>Sản phẩm còn trong thời gian bảo hành của nhà sản xuất.</li>
                            <li>Yêu cầu hoàn trả <strong>chỉ được thực hiện trong 3 ngày đầu kể từ khi nhận hàng</strong>. Nếu quá hạn nhưng vẫn còn thời gian bảo hành, khách hàng vui lòng liên hệ Admin để được hỗ trợ.</li>
                            <li>Nếu sản phẩm được đổi mới nguyên hộp, sản phẩm hoàn trả cũng phải gửi lại <strong>nguyên hộp đầy đủ phụ kiện</strong>. Nếu chỉ gửi sản phẩm lỗi riêng lẻ mà không có hộp/phụ kiện, sẽ được xử lý theo quy định của Admin.</li>
                        </ul>

                        <h5>Phương thức hoàn trả:</h5>
                        <ul>
                            <li>Khách hàng gửi sản phẩm về shop, sau khi kiểm tra xác nhận lỗi từ nhà sản xuất.</li>
                            <li>Admin sẽ hoàn tiền qua các ngân hàng được shop quy định hoặc qua ví Momo.</li>
                            <li>Thời gian xử lý hoàn tiền sẽ được thông báo trực tiếp cho khách hàng sau khi shop nhận hàng.</li>
                        </ul>
                    </section>

                    {{-- 3. Chính sách thanh toán --}}
                    <section class="mb-4">
                        <h4>3. Chính sách thanh toán</h4>
                        <p>Hỗ trợ các phương thức thanh toán: COD, chuyển khoản.</p>
                        <p>Trong trường hợp thanh toán không thành công hoặc hủy, khách hàng có thể thử lại hoặc liên hệ Admin để được hỗ trợ.</p>
                    </section>

                    {{-- 4. Chính sách vận chuyển --}}
                    <section class="mb-4">
                        <h4>4. Chính sách vận chuyển</h4>
                        <p>Đơn hàng sẽ được giao trong vòng 1-5 ngày làm việc tùy theo khu vực. Chúng tôi sử dụng các đối tác vận chuyển uy tín để đảm bảo hàng hóa đến tay khách hàng nhanh chóng và an toàn.</p>
                        <p>Mọi vấn đề phát sinh trong quá trình vận chuyển, khách hàng vui lòng liên hệ bộ phận hỗ trợ để được hướng dẫn xử lý.</p>
                    </section>

                    {{-- 5. Liên hệ hỗ trợ --}}
                    <section class="mb-4">
                        <h4>5. Liên hệ hỗ trợ</h4>
                        <p>Mọi thắc mắc về chính sách hoặc đơn hàng, vui lòng liên hệ hotline: 123456789.</p>
                    </section>

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
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    border-radius: 10px;
}
.card h4 {
    font-weight: 600;
    color: #333;
}
.card h5 {
    font-weight: 500;
    color: #555;
}
.card p, .card li {
    color: #555;
    line-height: 1.6;
}
.card ul {
    padding-left: 20px;
}
</style>
@endpush
