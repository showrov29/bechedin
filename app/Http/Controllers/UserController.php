<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getAllUsers(){
        return collect([
            "success" => true,
            "users" =>[1,2,3,4,5]
        ]);
    }

    function login(Request $request){
    
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        return collect([
            "success" => true,
            "message" =>"Login Successfully"
        ]);
    }

    function signIn(Request $request){

 $request->validate([

            'name' =>'required | max:20',
            'email' =>'required | email',
            'password' =>'required | max:20 | min:6',
            'phone' =>'required | max:11 | min:11'
        ]);

         return response()->json($request, 400);

    }
}
