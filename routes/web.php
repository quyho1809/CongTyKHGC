<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Mail;



Route::get('/',[UserController::class,'Home']);

Route::get('/profile/test', [UserController::class, 'Test']);

Route::post('/URL',[UserController::class,'Signup']);

Route::get('/SignUp',[UserController::class,'ShowSignUp']);

Route::post('/SignUp',[UserController::class,'Signup'])->name('shop.SignUp');

Route::get('/LogOn',function(){
    return view('components.login');
})->name('login');

Route::get('/mail',function()
{
    Mail::raw('Cam on da dang nhap', function ($message) {
        
        $message->to('john@johndoe.com', 'John Doe');
        
    });


});