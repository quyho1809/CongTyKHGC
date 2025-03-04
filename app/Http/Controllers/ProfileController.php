<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  
    public function edit(User $user)
    {
        return view('components.edit', compact('user'));
    }

  
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:20',
            'address' => 'nullable|string|max:200',
        ]);

        $user->update($request->only('first_name', 'last_name', 'address'));

        return redirect()->route('profile.edit', $user)->with('success', 'Cập nhật hồ sơ thành công.');
    }
}
