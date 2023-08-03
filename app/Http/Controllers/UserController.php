<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Validator;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\FileIterator\Factory;
use Tymon\JWTAuth\Facades\JWTAuth;

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
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string|max:100'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    if (!$token = Auth()->attempt($validator->validated())) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return $this->respondWithToken($token);
}

public function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60,
        'user' => auth()->user()
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


