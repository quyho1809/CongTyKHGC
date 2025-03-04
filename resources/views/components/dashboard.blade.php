<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background: #007bff;
            color: #fff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .user-info {
            font-size: 16px;
        }
        .logout-btn {
            padding: 8px 15px;
            background: red;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background: darkred;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>

    <div class="header" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background: #f8f9fa; border-bottom: 1px solid #ddd;">
        <div class="logo">
            <h2>Dashboard</h2>
        </div>
    
        <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
            @if(Auth::check())
            <a href="{{ route('profile.edit', Auth::user()) }}" class="text-dark fw-bold text-decoration-none">
                {{ auth()->user()->name }}
            </a>
            
                <a href="{{ route('logout') }}" class="logout-btn" style="padding: 8px 12px; background: red; color: white; text-decoration: none; border-radius: 5px;">Đăng xuất</a>
            @else
                <a href="{{ route('login') }}" style="padding: 8px 12px; background: blue; color: white; text-decoration: none; border-radius: 5px;">Đăng nhập</a>
            @endif
        </div>
    </div>
    
    

    <div class="container">
        <h1>Chào mừng bạn đến với Dashboard</h1>
        <p>Đây là trang quản trị dành cho người dùng.</p>

        @if(session('success'))
            <p style="color: green; text-align: center;">{{ session('success') }}</p>
        @endif
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; {{ date('Y') }} Website của bạn. All rights reserved.</p>
    </footer>

</body>
</html>
