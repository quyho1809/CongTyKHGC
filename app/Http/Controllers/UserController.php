<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserRequest;
use App\Jobs\SendWelcomeEmail;
use App\Notifications\ResetPasswordNotification;



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserRequest;
use App\Jobs\SendWelcomeEmail;

class UserController extends Controller
{
   
    public function home()
    {
        $user = User::find(1);
        if (!$user) {
            return view('components.index')->with('error', 'User không tồn tại.');
        }
        return view('components.index', compact('user'));
    }

   
    public function showLogin()
    {
        return view('components.login');
    }

   
    public function showSignUp()
    {
        return view('components.signup');
    }


    public function signup(UserRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
            ]);

            dispatch(new SendWelcomeEmail($user));

            return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy kiểm tra email của bạn.');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    protected $routeMiddleware = [
        // Middleware có sẵn
        'auth' => \App\Http\Middleware\Authenticate::class,
    
        // Middleware mới
        'own.profile' => \App\Http\Middleware\EnsureUserOwnsProfile::class,
    ];
}

