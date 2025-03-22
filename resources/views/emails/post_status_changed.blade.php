<p>Xin chào {{ $post->user->name }},</p>

<p>Bài viết "{{ $post->title }}" của bạn đã được cập nhật trạng thái:</p>

@if($post->status == 1)
    <p><strong>Đã được phê duyệt.</strong></p>
@elseif($post->status == 2)
    <p><strong>Đã bị từ chối.</strong></p>
@endif

<p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
