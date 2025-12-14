<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'phone_number'=>'required|string|max:255',
            'password'=>'required|string|max:255|confirmed',
            'born_date'=>'required|max:255|date',
        ]);
        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
            'born_date'=>$request->born_date,
        ]);
        return response()->json([
            'message'=>'user registerd successfully',
            'user'=>$user
        ],201);
    }
    public function login(Request $request){
    $request->validate([
            'phone_number'=>'required',
            'password'=>'required',
        ]);
    $user=User::where('phone_number',$request->phone_number)->FirstOrFail();
    if(!Auth::attempt($request->only('phone_number','password')))
        return response()->json([
            'messege'=>'invalid phone number or password'
        ],401);
$token=$user->createToken('auth_Token')->plainTextToken;
return response()->json(
    ['messege'=>'login successfully'
        ,'user'=>$user
        , 'token'=>$token],201);
    }
}
