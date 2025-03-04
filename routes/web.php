<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\EnsureUserOwnsProfile;
use App\Models\User; 


/* Trang chủ */
Route::get('/', [UserController::class, 'Home']);

/* Đăng ký */
Route::get('/sign-up', [UserController::class, 'ShowSignUp'])->name('register');
Route::post('/sign-up', [UserController::class, 'signup'])->name('register.submit');

/* Đăng nhập */
Route::get('/login', [LoginController::class, 'ShowLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logon', function () {
    return redirect()->route('login');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


/* Quên mật khẩu */
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

/* Khu vực chỉ dành cho người dùng đã đăng nhập */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('components.dashboard');
    })->name('dashboard');
});
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /* Hồ sơ người dùng */
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])
            ->middleware(EnsureUserOwnsProfile::class)
            ->name('profile.edit');
    
        Route::put('/profile/{user}', [ProfileController::class, 'update'])
            ->middleware(EnsureUserOwnsProfile::class)
            ->name('profile.update');
    });
/* Gửi email test */
Route::get('/mail', function () {
    Mail::raw('Cảm ơn bạn đã đăng nhập!', function ($message) {
        $message->to('email@example.com', 'User Name')->subject('Thông báo đăng nhập');
    });
    return 'Email đã gửi thành công!';
});
