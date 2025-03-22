<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Mail\PostStatusChanged;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function managePosts(Request $request)
    {
        $query = Post::query();

        // Tìm kiếm theo title hoặc email user
        if ($request->has('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhereHas('user', function ($q) use ($request) {
                      $q->where('email', 'like', "%{$request->search}%");
                  });
        }

        $posts = $query->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
{
    $post->update($request->all());

    Mail::to($post->user->email)->queue(new PostStatusChanged($post));

    return redirect()->route('admin.posts')->with('success', 'Cập nhật bài viết thành công!');
}
}

