<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Middleware\CheckUserStatus;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\ForgotPasswordController;

use App\Http\Controllers\PasswordResetController;

Route::get('/',[UserController::class,'Home']);

Route::get('/sign-up',[UserController::class,'ShowSignUp'])->name('sign-up');

Route::post('/log-in',[UserController::class,'signup'])->name('shop.SignUp');

Route::get('/logon',[UserController::class,'Showlogin'])->name('DashLogin');

Route::post('/logon',[LoginController::class,'login']);

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);

Route::middleware(['web'])->group(function () {
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});


Route::middleware(['auth:user','user.check'])->group(function ()
 {
    Route::get('/dashboard', function()
    {
        return view('components.dashboard');
    });

    Route::post('/user-logout',[LoginController::class,'logout'])->name('user.logout');
    
});

Route::get('/Login',function(){
    return view('components.login');
})->name('login');

Route::get('/mail',function()
{
    Mail::raw('Cam on da dang nhap', function ($message) {
        
        $message->to('john@johndoe.com', 'John Doe');
        
    });


});