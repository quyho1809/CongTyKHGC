@extends('adminlte::page')

@section('title', 'Quản lý bài viết')

@section('content')
    <div class="container">
        <h2 class="my-3">Danh sách bài viết</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <form method="GET">
                <input type="text" name="search" class="form-control w-25 d-inline" 
                       placeholder="Tìm theo tiêu đề hoặc email" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>

            
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay về trang chủ
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Ngày đăng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><img src="{{ $post->thumbnail }}" width="100" alt="Thumbnail"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->publish_date }}</td>
                        <td>
                            @if($post->status == 0)
                                <span class="badge bg-warning">Chưa duyệt</span>
                            @elseif($post->status == 1)
                                <span class="badge bg-success">Đã duyệt</span>
                            @else
                                <span class="badge bg-danger">Từ chối</span>
                            @endif
                        </td>
                        <td> 
                            <a href="/admin/posts/edit/{{ $post->id }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Sửa
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
    </div>
@endsection
