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

        return response()->created('User signup successfully.');
    }

    public function login(LoginRequest $req)
    {
        // authentication with login form data
        if (Auth::attempt($req->all()))

            // response with access token
            return response()->ok([
                'message' => 'User login successfully.',
                'accessToken' => Auth::user()->createToken('accessToken')->plainTextToken,
                'user' => Auth::user()
            ]);
        else
            return response()->badRequest('Invalid user credentials.');
    }

    public function logout(Request $req)
    {
        // delete current user access token
        $req->user()->currentAccessToken()->delete();

        return response()->ok('User logout successfully.');
    }
}