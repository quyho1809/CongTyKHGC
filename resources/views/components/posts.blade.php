@extends('layouts.template')

@section('content')
    <h2>Danh sách bài viết của bạn</h2>
    <a href="{{ route('show.create.post') }}" class="btn btn-primary">Tạo mới bài viết</a>

    <!-- Form xóa tất cả bài viết -->
    <form action="{{ route('posts.destroy.all') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tất cả bài viết không?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"></i> Xóa tất cả
        </button>
    </form>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Ngày đăng</th>
                <th>Trạng thái</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->publish_date }}</td>
                    <td>{{ $post->status == 1 ? 'Đã cập nhật' : 'Chờ duyệt' }}</td> 
                    <td>
                            <img src="{{ $post->thumbnail}}" alt="Thumbnail" width="100">
                    </td>       
                    <td>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                        </a>
                    
                        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                    
                        <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection
