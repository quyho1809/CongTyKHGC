@extends('adminlte::page')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
    <div class="container">
        <h2 class="my-3">Chỉnh sửa bài viết</h2>

    <a href="/admin">Quay lai</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.edit', $post->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Chưa duyệt</option>
                    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="2" {{ $post->status == 2 ? 'selected' : '' }}>Từ chối</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
        </form>
    </div>
@endsection
