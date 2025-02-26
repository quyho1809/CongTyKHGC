<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function Page()
    {
        $user = User::find(1);
        return view('components.index',compact('user'));

        
    } 

    public function Test()
    {
        $name_1 = 'Quy Ho'; 

        $user   = User::find(1);


        return view('components.test',compact('name_1','user'));
    }

    
}


