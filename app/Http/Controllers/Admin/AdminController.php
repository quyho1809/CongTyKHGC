<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($q) use ($request) {
                      $q->where('email', 'like', '%' . $request->search . '%');
                  });
        }

        $posts = $query->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'status' => 'required|in:0,1,2',
        ]);
        $post = Post::find($id);
        $post->update($request->only('title', 'status'));

        return back()->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete(); 

    return back()->with('success', 'Xóa bài viết thành công!');
}


public function updateStatus(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->status = $request->status;
    $user->save();

    if ($user->status == 0 && Auth::id() == $user->id) {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa.');
    }

    return back()->with('success', 'Cập nhật trạng thái thành công!');
}
}
