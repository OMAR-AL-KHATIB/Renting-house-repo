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
            'id_image'=>'required|max:2048|mimes:png,jpg,gif,jpeg|image',
            'profile_image'=>'required|max:2048|mimes:png,jpg,gif,jpeg|image'
            ]);
        if($request->hasFile('id_image')){
            $path=$request->File('id_image')->getClientOriginalName();
            request()->File('id_image')->storeAs('avatars', $path, 'public');
        }
        if($request->hasFile('profile_image')){
            $path2=$request->File('profile_image')->getClientOriginalName();
            request()->File('profile_image')->storeAs('avatars', $path2, 'public');
        }
$validation=$request->validate(['admin_acception'=>'required|boolean']);
        if($validation) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'born_date' => $request->born_date,
                'id_image' => $path,
                'profile_image' => $path2
            ]);
        }
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

        if(!Auth::attempt($request->only('phone_number','password')))
            return response()->json([
                'messege'=>'invalid phone number or password'
            ],401);
    $user=User::where('phone_number',$request->phone_number)->FirstOrFail();
$token=$user->createToken('auth_Token')->plainTextToken;
return response()->json(
    ['messege'=>'login successfully'
        ,'user'=>$user
        , 'token'=>$token],201);
    }
    public function update(Request $request){
        $validatedata=$request->validate([
            'first_name'=>'nuallable|string|max:255',
            'last_name'=>'nullable|string|max:255',
            'profile_image'=>'nullable|max:2048|mimes:png,jpg,gif,jpeg|image'
        ]);
        if($request->hasFile('profile_image'))
        $path=$request->File('profile_image')->getClientOriginalName();
        request()->File('profile_image')->storeAs('avatars', $path ,'public');
        $validatedata['profile_image']=$path;
        $new_user=User::update($validatedata);
        return response()->json($new_user,201);
    }
    public function show($id){
        $user=User::find($id);
   return response()->json($user,200);
     }
     public function index()
     {
         $user = User::all();
         return response()->json($user, 200);

     }
     public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
            return response()->json('messege=>logout successfully');
     }
    public function getUserReservations(Request $request){
        $user_id=Auth::user()->id;
        $validation=$request->validate(['user_id:required|exists:users,id']);
        $validation['user_id']=$user_id;

        $reservations=User::findOrFail($validation)->states;
        return response()->json($reservations,201);
    }

}
