<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\EnsureUserOwnsProfile;
use App\Models\User; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Auth::routes();


Route::get('/shop/logout', [LoginController::class, 'userLogout'])->name('shop.logout');


/* Trang chủ */
Route::get('/', [UserController::class, 'Home'])->name('shop.home');

/* Đăng ký */
Route::get('/sign-up', [UserController::class, 'ShowSignUp'])->name('register');
Route::post('/sign-up', [UserController::class, 'signup'])->name('register.submit');

/* Đăng nhập */
Route::get('/login', [LoginController::class, 'ShowLogin'])->name('showlogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logon', function () {
    return redirect()->route('login');
});



/* Quên mật khẩu */
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');;

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

/* Khu vực chỉ dành cho người dùng đã đăng nhập */
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

    /* Hồ sơ người dùng */
    Route::middleware(['user.check'])->group(function () {

        Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');
    
        Route::put('/profile/{user}', [ProfileController::class, 'update'])
            ->name('profile.update');


    });
    
/* Gửi email test */
Route::get('/mail', function () {
    Mail::raw('Cảm ơn bạn đã đăng nhập!', function ($message) {
        $message->to('email@example.com', 'User Name')->subject('Thông báo đăng nhập');
    });
    return 'Email đã gửi thành công!';

});

Route::middleware(['auth'])->group(function () {
    Route::get('/your-post', [PostController::class, 'yourPost'])->name('your.post');
    Route::get('/create-your-post', [PostController::class, 'showCreatePost'])->name('show.create.post');
    Route::post('/create-your-post', [PostController::class, 'createPost'])->name('create.post');

});
Route::middleware(['auth'])->group(function () {
    Route::delete('/posts/delete', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/posts/delete-all', [PostController::class, 'destroyAll'])->name('posts.destroy.all');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/your-post', [PostController::class, 'yourPost'])->name('your.post');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
