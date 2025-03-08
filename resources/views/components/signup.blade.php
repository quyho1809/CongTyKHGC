@extends('layouts.template')

@section('content')
    


<div class="container">
    <div class="register-container">
        @if (session('success'))
            <script>
                alert('{{ session('success') }}')
            </script>
        @endif

        <h2 class="text-center">Đăng ký</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input class="form-control" name="first_name" type="text" value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input class="form-control" name="last_name" type="text" value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" type="email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" name="password" type="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Re-enter Password</label>
                <input class="form-control" name="password_confirmation" type="password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
            </div>
        </form>
    </div>
</div>

@endsection
