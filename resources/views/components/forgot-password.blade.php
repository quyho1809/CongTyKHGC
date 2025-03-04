@extends('layouts.template')

@section('content')
<div class="container">
    <h2>Forget Password</h2>
    <form method="POST" action="{{ route('password.request') }}">
        @csrf
        <label>Your Email</label>
        <input type="email" name="email" required>
        <button type="submit">Send password reset link</button>
    </form>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
</div>
@endsection
