<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(UserRequest $req)
    {
        // create user row
        User::create($req->all());

        // created response
        return response()->json(['message' => 'User signup successfully.'], 201);
    }

    public function login(LoginRequest $req)
    {
        // authentication with login form data
        if (Auth::attempt($req->all()))

            // response with access token
            return response()->json(['message' => 'User login successfully.', 'token' => Auth::user()->createToken('accessToken')->plainTextToken], 200);
        else

            // unauthorized response
            return response()->json(['error' => 'Invalid user credentials'], 401);
    }

    public function logout(Request $req)
    {
        // delete all user access token
        $req->user()->tokens()->delete();
        return response()->json(['message' => 'User logout successfully.'], 200);
    }
}