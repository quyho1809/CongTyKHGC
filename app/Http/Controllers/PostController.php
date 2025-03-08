<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết của user
    public function yourPost()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        return view('components.posts', compact('posts'));
    }

    // Hiển thị trang tạo bài viết
    public function showCreatePost()
    {
        return view('components.createpost');
    }

    // Xử lý tạo bài viết
    public function createPost(PostRequest $request)
    {
        Post::create([
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'slug'         => \Str::slug($request->title),
            'description'  => $request->description,
            'content'      => $request->content,
            'publish_date' => $request->publish_date,
            'status'       => $request->status ?? 0,
        ]);

        return redirect()->route('your.post')->with('success', 'Bài viết đã được tạo thành công!');
    }
}
