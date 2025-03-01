<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Middleware\CheckUserStatus;

use App\Http\Controllers\LoginController;


Route::get('/',[UserController::class,'Home']);

Route::get('/sign-up',[UserController::class,'ShowSignUp'])->name('sign-up');

Route::post('/log-in',[UserController::class,'signup'])->name('shop.SignUp');

Route::get('/logon',[UserController::class,'Showlogin'])->name('DashLogin');

Route::post('/logon',[LoginController::class,'login']);


Route::middleware(['auth:user','checkUserStatus'])->group(function () {
    Route::get('/dashboard', function()
    {
        return view('components.dashboard');
    });
    
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