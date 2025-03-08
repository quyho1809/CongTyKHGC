@extends('layouts.template')

@section('content')
    <form action="{{ route('create.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="content" class="form-label">Content</label>
        <textarea id="content" name="content"></textarea>
        @error('content')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="publish_date" class="form-label">Publish Date</label>
        <input type="datetime-local" name="publish_date" class="form-control">
        @error('publish_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <input type="file" name="thumbnail" accept="image/*">
        @error('thumbnail')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <button type="submit" class="btn btn-primary">Create</button>


    </form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300, 
                placeholder: 'Nhập nội dung bài viết...',
                tabsize: 2
            });
        });
    </script>
@endsection
