<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header -->
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

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Reset Your Password</h2>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" required>    
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required>
                    @error('password_confirmation')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            
                <button type="submit" class="btn">Update Password</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 Website của bạn. All rights reserved.
    </footer>

</body>
</html>
