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
    // Hiển thị danh sách bài viết của user
    public function yourPost()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->paginate(10);
        return view('components.posts', compact('posts'));
    }

    // Hiển thị form tạo bài viết
    public function showCreatePost()
    {
        return view('components.createpost');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $post = Post::where('user_id', auth()->id())->findOrFail($id);

        // Xóa ảnh nếu có
        if ($post->thumbnail && file_exists(public_path($post->thumbnail))) {
            unlink(public_path($post->thumbnail));
        }

        $post->delete();
        return response()->json(['message' => 'Xóa bài viết thành công!']);
    }

    // Xóa tất cả bài viết
    public function destroyAll()
    {
        $posts = auth()->user()->posts;
        
        foreach ($posts as $post) {
            if ($post->thumbnail && file_exists(public_path($post->thumbnail))) {
                unlink(public_path($post->thumbnail));
            }
            $post->delete();
        }

        return redirect()->route('your.post')->with('success', 'Xóa tất cả bài viết thành công!');
    }

    // Tạo bài viết mới
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

        // Lưu ảnh vào thư mục public/uploads
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'uploads/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            // Lưu đường dẫn ảnh vào database
            $post->update(['thumbnail' => $filename]);
        }

        return redirect()->route('your.post')->with('success', 'Bài viết đã được tạo thành công!');
    }

    // Hiển thị trang chỉnh sửa bài viết
    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(404); 
        }
    
        return view('components.editpost', compact('post'));
    }

    // Xem bài viết
    public function show(Post $post)
    {
        if (auth()->check() && auth()->id() !== $post->user_id) {
            abort(403); 
        }
    
        return view('components.showpost', compact('post'));
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->has('status') && auth()->user()->role !== 'admin') {
            return redirect()->route('your.post')->with('error', 'Bạn không có quyền thay đổi trạng thái bài viết!');
        }

        // Xóa ảnh cũ và lưu ảnh mới nếu có
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail && file_exists(public_path($post->thumbnail))) {
                unlink(public_path($post->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = 'uploads/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $post->update(['thumbnail' => $filename]);
        }

        if ($request->has('title')) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $post->update($request->except(['status', 'thumbnail']));

        return redirect()->route('your.post')->with('success', 'Cập nhật bài viết thành công');
    }
}
