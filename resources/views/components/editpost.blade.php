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

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" id="editor">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Chờ duyệt</option>
                    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Đã cập nhật</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('your.post') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>


    
    @endsection
