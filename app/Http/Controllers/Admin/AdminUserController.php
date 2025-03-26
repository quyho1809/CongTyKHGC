<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Tìm kiếm theo tên hoặc email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:20',
        'address' => 'nullable|string|max:200',
        'status' => 'required|in:0,1,2,3', 
    ]);

    $user = User::findOrFail($id);
    $oldStatus = $user->status;

    $user->update($request->all());

    
    if (in_array($user->status, [0, 2, 3]) && $oldStatus != $user->status) {
        Auth::logout();
    }

    return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản thành công!');
}

}
