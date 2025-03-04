<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <p>Xin chào,</p>
    <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấp vào liên kết bên dưới để tiếp tục:</p>
    <a href="{{ url('/reset-password/'.$token) }}">Đặt lại mật khẩu</a>
    <p>Nếu bạn không yêu cầu, hãy bỏ qua email này.</p>
</body>
</html>
