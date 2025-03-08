<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
   
    public function yourPost()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        return view('components.posts', compact('posts'));
    }

  
    public function showCreatePost()
    {
        return view('components.createpost');
    }

    public function createPost(CreatePostRequest $request)
    {
        $post = Post::create([
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'description'  => $request->description,
            'content'      => $request->content,
            'publish_date' => $request->publish_date,
            'status'       => $request->status ?? 0,
        ]);
    
      
        if ($request->hasFile('thumbnail')) {
            $post->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnails');
        }
    
        return redirect()->route('your.post')->with('success', 'Bài viết đã được tạo thành công!');
    }
    

}
