<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use DataTables;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with('user')->select('posts.*');

            return DataTables::of($posts)
                ->addColumn('user', function ($post) {
                    return $post->user->email;
                })
                ->addColumn('status', function ($post) {
                    return $post->status == 1 ? 'Đã duyệt' : 'Chưa duyệt';
                })
                ->addColumn('action', function ($post) {
                    return '
                        <a href="' . route('admin.posts.edit', $post->id) . '" class="btn btn-sm btn-primary">Sửa</a>
                        <button class="btn btn-sm btn-danger delete-post" data-id="' . $post->id . '">Xóa</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.posts.index');
    }
}

