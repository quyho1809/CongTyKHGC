@extends('layouts.template')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa bài viết</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" class="form-control">{{ old('description', $post->description) }}</textarea>
            </div>

            <label for="content" class="content-label">Content</label>
            <textarea name="content" class="form-control summernote"></textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror       
            
            <label for="thumbnail">Upload Thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*" class="form-control">
            
            @error('thumbnail')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <img src="{{ $post->thumbnail }}" alt="">

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('your.post') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
    
   
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,  
                placeholder: "Nhập nội dung bài viết...",

            });
        });
    </script>
    
    @endsection
