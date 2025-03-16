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
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->id())->findOrFail($id);
        $post->delete();
    
        return response()->json(['message' => 'Xóa bài viết thành công!']);
    }
    
    public function destroyAll()
    {
        auth()->user()->posts()->delete();
    
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
            $post->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnails');
        }
    
        return redirect()->route('your.post')->with('success', 'Bài viết đã được tạo thành công!');
    }
    
    
    public function edit($id)
    {
    $post = Post::where('user_id', auth()->id())->findOrFail($id);
    return view('components.editpost', compact('post'));
}
    public function show($id)
{
    $post = Post::where('user_id', auth()->id())->findOrFail($id);
    return view('components.showpost', compact('post'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'title'       => 'required|max:100',
        'description' => 'nullable|max:200',
        'content'     => 'required',
        'status'      => 'required|in:0,1',
    ]);

    $post = Post::where('user_id', auth()->id())->findOrFail($id);
    $post->update([
        'title'       => $request->title,
        'description' => $request->description,
        'content'     => $request->content,
        'status'      => $request->status,
    ]);

    return redirect()->route('your.post')->with('success', 'Bài viết đã được cập nhật thành công!');
}

}
