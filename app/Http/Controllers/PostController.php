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

    
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->delete(); // Soft delete
    
        return redirect()->back()->with('success', 'Xóa bài viết thành công!');
        
    }
   
public function destroyAll()
{
    $posts = auth()->user()->posts;
    
    foreach ($posts as $post) {
        $post->clearMediaCollection('thumbnails');
        $post->delete();
    }

    return redirect()->route('your.post')->with('success', 'Xóa tất cả bài viết thành công!');
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
            $post->addMedia($request->file('thumbnail'))
                 ->toMediaCollection('thumbnails','media-library');
        }

        return redirect()->route('your.post')->with('success', 'Bài viết đã được tạo thành công!');
    }

    
    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(404); 
        }
    
        return view('components.editpost', compact('post'));
    }

    
    public function show(Post $post)
    {
        if (auth()->check() && auth()->id() !== $post->user_id) {
            abort(403); 
        }
    
        return view('components.showpost', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        if ($request->has('status') && auth()->user()->role !== 'admin') {
            return redirect()->route('your.post')->with('error', 'Bạn không có quyền thay đổi trạng thái bài viết!');
        }
    
        
        if ($request->hasFile('thumbnail')) {
            $post->clearMediaCollection('thumbnails'); 
            $post->addMediaFromRequest('thumbnail')
                 ->toMediaCollection('thumbnails'); 
        }
    
        if ($request->has('title')) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }
    
        $post->update($request->except(['status', 'thumbnail']));
    
        return redirect()->route('your.post')->with('success', 'Cập nhật bài viết thành công');
    }
    
}
