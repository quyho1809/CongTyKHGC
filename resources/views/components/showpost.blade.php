@extends('layouts.template')

@section('content')
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <p><strong>Ngày đăng:</strong> {{ $post->publish_date }}</p>
        <p><strong>Trạng thái:</strong> {{ $post->status == 1 ? 'Đã cập nhật' : 'Chờ duyệt' }}</p>
        <p><strong>Mô tả:</strong> {{ $post->description }}</p>
        <p><strong>Nội dung:</strong></p>
        <div>{!! $post->content !!}</div>
        @if($post->thumbnail)
            <img src="{{ $post->thumbnail }}" alt="Thumbnail" width="300">
        @endif
        <a href="{{ route('your.post') }}" class="btn btn-secondary">Quay lại</a>
    </div>
@endsection
