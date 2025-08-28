<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function store(Request $req)
    {
        User::create($req->all());
        return response()->json(['message' => 'User created successfully.'], 200);
    }

    public function show(User $user)
    {
        return response()->json(User::find($user->id), 200);
    }

    public function update(Request $req, User $user)
    {
        User::find($user->id)->update($req->all());
        return response()->json(['message' => 'User updated successfully.'], 200);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}