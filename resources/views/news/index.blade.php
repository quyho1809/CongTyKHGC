    @extends('layouts.template')

    @section('content')
    <div class="container">
        <h2 class="mb-4">Tin tức</h2>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $post->thumbnail }}" alt="Thumbnail" width="200">


                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                            </h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <p class="text-muted">Ngày đăng: {{ $post->publish_date }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
    @endsection
