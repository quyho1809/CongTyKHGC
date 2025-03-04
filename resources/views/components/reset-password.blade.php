@extends('layouts.template')

@section('content')
    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
    
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
        <label for="password">New Password</label>
        <input type="password" name="password" value="{{ old('password') }}">
        @error('password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
        <label for="password_confirmation">Re-enter Password</label>
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
        @error('password_confirmation')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    
        <button type="submit">Reset Password</button>
    </form>
    </form>
    
    
@endsection
