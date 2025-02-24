<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Mail;

Route::get('/',[UserController::class,'Page']);


Route::get('/profile/test', [UserController::class, 'Test']);


Route::get('/mail',function()
{
    Mail::raw('Cam on da dang nhap', function ($message) {
        
        $message->to('john@johndoe.com', 'John Doe');
        
    });
});