<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Mockery\Expectation;
use Carbon\Carbon;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

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
            $newUser->verification=Str::uuid();
            

            Mail::raw("http://127.0.0.1:8000/".$newUser->verification,function($message) use ($newUser){
                $message->to($newUser->email);
                $message->subject("Verify Your Email");
            });

            // Mail::raw('hello',function(Message $message){
            //         $message->to('showrovislam29@gmail.com')
            //         ->from('abcdhealthcare24@gmail.com');
            // });
            
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
            $newAdmin->verification=Str::uuid();
            $newAdmin->status=true;
            

            $newAdmin->save();
            return response()->json(["message" =>"Admin added successfully","success"=>true],200);
        }
        catch(Expectation $e){
            return response()->json($e,500);
        }

    }


    function verify(string $id){

        try{

           

            $user= User::where('verification','=',$id)->update(['status' => true,'email_verified_at'=>Carbon::now()]);
           
            return response()->json(["message" =>"Verified","success"=>true],200);

        }
        catch(Expectation $e){
            return response()->json(["messege"=>"Something went wrong"],400);
        }
    }
}
