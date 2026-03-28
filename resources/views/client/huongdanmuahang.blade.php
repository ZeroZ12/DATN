@extends('client.layouts.app')
@section('title', 'Trang hướng dẫn mua hàng')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-danger">Hướng Dẫn Mua Hàng Tại TOP PC</h2>
        <ol class="list-group list-group-numbered mb-4">
            <li class="list-group-item">
                <strong>Đăng ký tài khoản</strong><br>
                - Nhấn vào biểu tượng <a href="{{ route('register') }}">Đăng ký</a> ở góc phải trên cùng. <br>
                - Điền đầy đủ thông tin cá nhân và nhấn <b>Đăng ký</b>.
            </li>
            <li class="list-group-item">
                <strong>Đăng Nhập:</strong>
                - Nhấn vào biểu tượng <a href="{{ route('login') }}">Đăng Nhập</a>. <br>
                - Nhập email và mật khẩu, sau đó nhấn <b>Đăng Nhập</b>.
            </li>
            <li class="list-group-item">
                <strong>Tìm kiếm sản phẩm:</strong><br>
                - Sử dụng thanh tìm kiếm ở đầu trang để nhập tên sản phẩm hoặc danh mục. <br>
                - Hoặc duyệt các danh mục sản phẩm ở menu.
            </li>
            <li class="list-group-item">
                <strong>Chọn và xem chi tiết sản phẩm:</strong> <br>
                - Nhấn vào sản phẩm để xem thông tin chi tiết, hình ảnh,
                 giá và các tùy chọn cấu hình.
            </li>
            <li class="list-group-item">
                <strong>Thêm sản phẩm vào giỏ hàng:</strong>
                - Vào trang <b>Giỏ hàng</b> để kiểm tra, thay đổi số lượng hoặc xóa sản phẩm. <br>
                - Nhập mã giảm giá (nếu có) để được ưu đãi.
            </li>
            <li class="list-group-item">
                <strong>Đặt hàng:</strong>
                - Nhấn nút <b>Thanh toán</b>. <br>
                - Điền thông tin nhận hàng, chọn phương thức thanh toán. <br>
                - Xác nhận đơn hàng để hoàn tất mua hàng.
            </li>
        </ol>
        <div class="alert alert-info">
            Nếu cần hỗ trợ, hãy liên hệ bộ phận chăm sóc khách hàng qua chat hoặc hotline trên website.
        </div>
    </div>
@endsection

