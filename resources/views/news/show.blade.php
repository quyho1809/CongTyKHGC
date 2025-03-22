@extends('layouts.template')

@section('content')
<div class="container">
    <h2>{{ $post->title }}</h2>
    <img src="{{ asset('image/' . $post->thumbnail) }}" alt="Thumbnail">

    <p class="text-muted">Ngày đăng: {{ $post->publish_date }}</p>
    <p class="lead">{{ $post->description }}</p>
    <div class="content">
        {!! $post->content !!}
    </div>
</div>
@endsection
