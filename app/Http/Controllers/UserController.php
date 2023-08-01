<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Validator;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\FileIterator\Factory;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'name'=>'required|string|min:2|max:100',
        'email'=> 'required| string|email|max:100|unique:users', //user table in models 
        'password'=> 'required| string|max:100|confirmed'  //  

       ]);
       if($validator->fails())
       {
        return response()->json($validator->errors(),400);
       }
       $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email, 
        'password'=>Hash::make($request->password), 
       ]);
        
       return response()->json([
        'message'=> 'user registered succesfully',
        'user'=>$user]);
    } 
    //for login
    public function login(Request $request)

    {
        $validator = Validator::make($request->all(),[
        
            'email'=>'required|email|string',
            'password'=>'required|string|min:6' 
    
           ]);

           if($validator->fails())
           {
            return response()->json($validator->errors(),400);
           }
           if(!$token = auth()->attempt($validator->validated()))
           {
            return response()->json(['error'=> 'unauthorized',401]);
           }
           return $this->respondwithtoken($token);
    }
            public function respondwithtoken($token)
            {
                return response()->json([
                    'access_token'=> $token,
                    'token_type'=> 'bearer',
                    'expires_in' =>auth()->factory()->getTT()*60,
                    'user'=>auth()->user()
                ]);
            }
            // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);
    //     $credentials = $request->only('email', 'password');

    //     $token = Auth::attempt($credentials);
    //     if (!$token) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Unauthorized',
    //         ], 401);
    //     }

    //     $user = Auth::user();
    //     return response()->json([
    //             'status' => 'success',
    //             'user' => $user,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);

    // }
    public function profile(Request $request){
        return response()->json(auth()->user());
    }
    public function logout(){
        auth()->logout();
        return response()->json([
            'message'=>'User logged out'
        ]);
    }
  
}


