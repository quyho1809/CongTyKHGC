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

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    
</head>

<body>

    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <a href="/" class="text-white text-decoration-none fs-4">LOGO</a>
                <ul class="nav">
                    <li class="nav-item"><a href="/" class="nav-link text-white">Home</a></li>

 

                    @auth
                    <li class="nav-item"><a href="/dashboard" class="nav-link text-white">Dashboard</a></li>

                        <li class="nav-item"><a href="/your-post" class="nav-link text-white">Post</a></li>

                        <li class="nav-item"><a href=" " class="nav-link text-white">My Profile</a></li>


                        <li class="nav-item">
                            <a href="{{ route('shop.logout') }}" class="nav-link text-white">Log Out</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item"><a href="/logon" class="nav-link text-white">Log in</a></li>
                        <li class="nav-item"><a href="/sign-up" class="nav-link text-white">Sign up</a></li>


                    @endguest


                </ul>


            </nav>
            @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
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
