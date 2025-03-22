<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    public function edit(Post $post)
{
    $this->authorize('update', $post); // Áp dụng Policy
    return view('components.editpost', compact('post'));
}
public function view(?User $user, Post $post)
{
    return true; // Ai cũng có thể xem bài viết
}


    public function __construct()
    {
        //
    }
}
