<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class Newcontroller extends Controller
{
    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
        'name'=>'required|string|min:2|max:100',
        'email'=> 'required| string|email|max:100|unique:users', 
        'password'=> 'required| string|max:100|confirmed'  

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
public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(compact('token'));
    }
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