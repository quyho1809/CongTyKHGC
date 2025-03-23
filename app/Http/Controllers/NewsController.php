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
    public function show($slug)
{
    $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();
    return view('news.show', compact('post'));
}
}
