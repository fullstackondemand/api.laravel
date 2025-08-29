<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $req)
    {
        /** Signup User Form Data */
        $user = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|confirmed',
        ]);

        // if form data is invalid
        if ($user->fails())
            return response()->json(['errors' => $user->errors()], 400);

        // create user row
        User::create($user->validated());

        // created response
        return response()->json(['message' => 'User signup successfully.'], 201);
    }

    public function login(Request $req)
    {
        /** Login User Form Data */
        $credentials = Validator::make($req->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        // if form data is invalid
        if ($credentials->fails())
            return response()->json(['errors' => $credentials->errors()], 400);

        // authentication with login form data
        if (Auth::attempt($credentials->validated()))

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