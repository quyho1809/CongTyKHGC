<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang Chủ')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            background: linear-gradient(135deg, #007bff, #0056b3);
            padding: 15px 0;
        }
        .navbar .nav-link {
            color: #fff;
            font-weight: 500;
            transition: color 0.3s;
        }
        .navbar .nav-link:hover {
            color: #ffcc00;
            transform: scale(1.1);
        }
        .news-container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .news-container.show {
            opacity: 1;
            transform: translateY(0);
        }
        .footer {
            background: #222;
            color: #ccc;
            padding: 20px 0;
            text-align: center;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
        }
        .btn-animated {
            transition: all 0.3s ease-in-out;
        }
        .btn-animated:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold">Trang Chủ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item"><a href="/news" class="nav-link">Tin Tức</a></li>
                    @auth
                        <li class="nav-item">
                            <a href="/your-post" class="nav-link">Bài Viết Của Bạn</a>
                        </li>
                        <li class="nav-item">
                            <a href="/profile" class="nav-link">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('shop.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white">Đăng Xuất</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a href="/login" class="nav-link">Đăng Nhập</a></li>
                        <li class="nav-item"><a href="/sign-up" class="nav-link">Đăng Ký</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Content -->
    <div class="container mt-4 news-container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer mt-4">
        <p>&copy; {{ date('Y') }} Tin Tức 24H. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for fade-in effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const newsContainer = document.querySelector(".news-container");
            if (newsContainer) {
                setTimeout(() => {
                    newsContainer.classList.add("show");
                }, 300);
            }
        });
    </script>
</body>

</html>