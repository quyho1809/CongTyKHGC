@extends('layouts.template')

@section('content')
    <div class="">
        @if (session('success'))
            <script>
                alert('{{session('success')}}')
            </script>
        @endif
        <form action="{{route('shop.SignUp')}}" method="POST">
            @csrf
            <div class="">
                <label class="label-label" for="first_name">First Name</label>
                <input class="form-control" name="first_name" type="text" value="{{ old('first_name') }}">
                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="">
                <label class="label-label" for="last_name">Last Name</label>
                <input class="form-control" name="last_name" type="text" value="{{ old('last_name') }}">
                @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="">
                <label class="label-label" for="email">Email</label>
                <input class="form-control" name="email" type="email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="">
                <label class="label-label" for="password">Password</label>
                <input class="form-control" name="password" type="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="">
                <label class="label-label" for="password_confirmation">Re-enter the password</label>
                <input class="form-control mb-4" name="password_confirmation" type="password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Send</button>
        </form>

    </div>
@endsection
