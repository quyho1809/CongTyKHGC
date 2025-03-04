<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/forgot_password.css}}">
</head>
<body>

 
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                
                <a href="/" class="text-white text-decoration-none fs-4">LOGO</a>

                <ul class="nav">
                    <li class="nav-item"><a href="/" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link text-white">Log in</a></li>
                    <li class="nav-item"><a href="/sign-up" class="nav-link text-white">Sign up</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mt-4">
        <h2 class="text-center">Quên Mật Khẩu</h2>
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('password.request') }}" class="w-50">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email của bạn</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Gửi liên kết đặt lại mật khẩu</button>
            </form>
        </div>

        @if (session('success'))
            <p class="text-success text-center mt-3">{{ session('success') }}</p>
        @endif
    </div>


    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Website của bạn. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
