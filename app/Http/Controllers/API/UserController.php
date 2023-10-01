<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use Spatie\Permission\Models\Role;
use App\Http\Resources\SendResponse;
use Auth;

class UserController extends Controller
{
    // Register User
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'phone_number' => $request->input('phone_number'),
        ]);

        $user_role = Role::where(['name' => 'user'])->first();
        if ($user_role){
            $user_role->assignRole($user_role);
        }
        return new SendResponse($user);
    }

    // // User Login
    // public function login(LoginRequest $request)
    // {
    //     if(!Auth::attempt($request->only('email', 'password'))){
    //        Helper::sendError('Email or Passwor are invalid');
    //     }
    //     $user = Auth::user();
    //     return new SendResponse($user);

    //     if(Auth::user()->role== '1'){

    //         return response()->json(['status' => 'Welcome to Admin dashboard']);
            
    //     }elseif(Auth::user()->role=='0'){
    //         return response()->json(['status' => 'Welcome to User dashboard']);
    //     }
    // }



    // User Login
public function login(LoginRequest $request)
{
    if (!Auth::attempt($request->only('email', 'password'))) {
        return Helper::sendError('Email or Password are invalid');
    }

    $user = Auth::user();

    if ($user->role == '1') {
        return new SendResponse($user);    
    } elseif ($user->role == '0') {
        return new SendResponse($user);
    }

    // You may want to handle other cases here as well
    return response()->json(['status' => 'Unknown role']);
}

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }

  
}

