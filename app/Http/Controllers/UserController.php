<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function Home()
    {
        $user = User::find(1);
        return view('components.index', compact('user'));
    } 
    
    public function Showlogin()
    {
        return view('components.login');
    }
    public function ShowSignUp()
    {
        return view('components.signup');
    }

    public function Signup(UserRequest $request)
{
    
    $user = User::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email'      => $request->email,
        'password'   => bcrypt($request->password)
    ]);

   
    if ($user) {
        Mail::to($user->email)->send(new WelcomeMail($user));
        return view('components.login')->with('success', 'Đăng ký thành công! Hãy kiểm tra email của bạn.');

    }

    return back()->with('error', 'Đăng ký thất bại, vui lòng thử lại.');
}

}
