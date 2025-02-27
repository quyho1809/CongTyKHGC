<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('css')
</head>
<body>

    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <a href="/" class="text-white text-decoration-none fs-4">LOGO</a>
                <ul class="nav">
                    <li class="nav-item"><a href="" class="nav-link text-white">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-white">Giới Thiệu</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-white">Log in</a></li>
                    <li class="nav-item"><a href="/SignUp" class="nav-link text-white">Sign up</a></li>                   
                    <li class="nav-item"><a href="" class="nav-link text-white">Liên Hệ</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Website của bạn. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
