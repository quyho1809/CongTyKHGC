@extends('layouts.template')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <img src="{{ $post->thumbnail }}" alt="Thumbnail" width="400">
    <p class="text-muted">Ngày đăng: {{ $post->publish_date }}</p>
    <p>{{ $post->description }}</p>
    <div>{!! $post->content !!}</div>
    <a href="{{ route('news.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
