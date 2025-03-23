@extends('layouts.template')

@section('content')
    

<div class="container">
    <h2 class="text-center">Cập Nhật Hồ Sơ</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('profile.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
            @error('first_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
            @error('last_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
    
        <button type="submit" class="btn">Cập nhật</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Quay lại</a>
    </form>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,  
                placeholder: "Nhập nội dung bài viết...",

            });
        });
    </script>
</div>



@endsection