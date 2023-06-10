<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Mockery\Expectation;

class UserController extends Controller
{
    function getAllUsers(){
      try{
        
        $users=User::where('type','=','user')->get();
        return response()->json($users,200);

      }
      catch(Expectation $e ){
        return response()->json($e,500);
      }
    }


    function getUserById(int $id){
      try{
        
        $user=User::with('advertisement')->find($id);
        
        
        return response()->json($user,200);

      }
      catch(Expectation $e ){
        return response()->json($e,500);
      }
    }


    function getAdminById(int $id){
      try{
        
        $admin=User::find($id);
        return response()->json($admin,200);

      }
      catch(Expectation $e ){
        return response()->json($e,500);
      }
    }


    function getAllAdmin(){
        try{
            $admins=User::where('type','=','admin')->get();
            return response()->json($admins,200);

        }
        catch(Expectation $e){
            return response()->json($e,500);
        }
    }

    function login(Request $request){
    
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
        try{
            $user=User::where('email','=',$request->email)->get();
            if ($user) {
                if ($user->type == 'user') {
                    if ($user->password ==md5($request->password)) {
                        return response()->json($user,200);
                     }
                     else{
                         return response()->json(["message"=>"Incorret password","success"=>false],403);
                     }
                }

            }
            else{
                return response()->json(["message"=>"Invalid email address","success"=>false],403);
            }
        }
        catch(Expectation $e){
            return response()->json($e,500);
        }
    }
    function adminLogin(Request $request){
    
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);
         try{
            $admin=User::where('email','=',$request->email)->get();
            if ($admin) {
                if ($admin->type == 'admin') {
                    if ($admin->password ==md5($request->password)) {
                        return response()->json($admin,200);
                     }
                     else{
                         return response()->json(["message"=>"Incorret password","success"=>false],403);
                     }
                }
                
            }
            else{
                return response()->json(["message"=>"Invalid email address","success"=>false],403);
            }
        }
        catch(Expectation $e){
            return response()->json($e,500);
        }
    }


    function signIn(Request $request){

        $request->validate([

            'name' =>'required | max:20',
            'email' =>'required | email',
            'password' =>'required | max:20 | min:6',
            'phone' =>'required | max:11 | min:11'
        ]);

        try{
            $newUser=new User();
            $newUser->name=$request->name;
            $newUser->email=$request->email;
            $newUser->password=md5($request->password);
            $newUser->phone=$request->phone;

            $newUser->save();

            return response()->json(["message" =>"User created successfully","success"=>true],200);
        }
        catch(Expectation $e){
            return response()->json($e,500);
        }

    }

    function adminSignIn(Request $request){

        $request->validate([

            'name' =>'required | max:20',
            'email' =>'required | email',
            'password' =>'required | max:20 | min:6',
            'phone' =>'required | max:11 | min:11'
        ]);

        try{
            $newAdmin=new User();
            $newAdmin->name=$request->name;
            $newAdmin->email=$request->email;
            $newAdmin->password=md5($request->password);
            $newAdmin->phone=$request->phone;
            $newAdmin->type='admin';
            

            $newAdmin->save();
            return response()->json(["message" =>"Admin added successfully","success"=>true],200);
        }
        catch(Expectation $e){
            return response()->json($e,500);
        }

    }
}
