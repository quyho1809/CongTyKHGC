<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Hiển thị danh sách bài viết đã được phê duyệt
    public function index()
    {
        $posts = Post::where('status', 1) // Chỉ lấy bài viết đã được phê duyệt
                     ->latest()
                     ->paginate(10);

        return view('news.index', compact('posts'));
    }

    // Hiển thị chi tiết bài viết theo slug
    public function show(Post $post)
    {
        if ($post->status !== 1) {
            abort(404); // Nếu bài viết chưa được duyệt, báo lỗi 404
        }

        return view('news.show', compact('post'));
    }
}
