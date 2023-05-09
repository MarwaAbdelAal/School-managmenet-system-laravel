<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthContoller extends Controller
{
    public function register(Request $request)
    {
        // authorize
        //validate

        // store
        // dd($request->all());
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        if($user->wasRecentlyCreated){
            $token = $user->createToken("auth_token");
            return response()->json([
                "message" => "User created successfully",
                "user" => $user,
                "token" => $token->plainTextToken,
            ], 201);
        }
        // generate token
        // redirect
    }

    public function login(Request $request)
    {
        // authorize
        if(Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])){
            return response()->json([
                "message" => "User logged in successfully",
                "user" => Auth::user(),
                "token" => Auth::user()->createToken("auth_token")->plainTextToken,
            ], 200);
        }
        // validate
        // authenticate
        // generate token
        // redirect
    }
}
