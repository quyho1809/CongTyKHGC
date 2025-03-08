@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Email Field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        {{-- Password Field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        {{-- Remember Me --}}
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Ghi nhớ đăng nhập
                    </label>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    <p class="mb-1">
        <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
    </p>
    <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Tạo tài khoản mới</a>
    </p>
@endsection
