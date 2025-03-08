@extends('layouts.template')

@section('content')
    <h2>Danh sách bài viết của bạn</h2>
    <a href="{{ route('show.create.post') }}" class="btn btn-primary">Tạo mới bài viết</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Ngày đăng</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
         @foreach($posts as $post)
         <tr>
             <td>{{ $post->title }}</td>
             <td>{{ $post->description }}</td>
             <td>{{ $post->publish_date }}</td>
             <td>{{ $post->status == 1 ? 'Đã cập nhật' : 'Chờ duyệt' }}</td>
             <td><img src="{{ $post->thumbnail }}" alt="Thumbnail" width="150"></td>
         </tr>
     @endforeach
     
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
