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
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;





Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Auth::routes();


Route::post('/shop/logout', [LoginController::class, 'logout'])->name('shop.logout');
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
Route::middleware(['auth','user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});



/* Quên mật khẩu */
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');;

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('components.dashboard');
    })->name('dashboard');
});
Route::middleware([ 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

    /* Hồ sơ người dùng */
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
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
    Route::delete('/posts/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::delete('/posts/delete-all', [PostController::class, 'destroyAll'])->name('posts.destroy.all');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); 
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
});
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {

    
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


});
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index'); 
route::get('/admin/users/edit/{id?}',[AdminUserController::class,'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');


Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
 
Route::get('/admin/posts/edit/{id?}',[AdminController::class,'edit'])->name('admin.edit');

Route::post('/admin/posts/edit/{id?}',[AdminController::class,'update'])->name('admin.edit');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
