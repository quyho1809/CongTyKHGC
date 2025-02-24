<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Page()
    {
        return view('components.index');
    } 

    public function Test()
    {
        $name_1 = 'Quy Ho'; //

        $name_2 = "Thinh";
        
        $name_3 = "a";

        $name_4=    "b";

        return view('components.test',compact('name_1','name_2','name_3','name_4'));
    }
}


