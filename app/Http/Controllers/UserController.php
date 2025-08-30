<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // get all user records
        return response()->ok(UserResource::collection(User::all()));
    }

    public function store(UserRequest $req)
    {
        // insert a new user record
        User::create($req->all());

        return response()->created('User created successfully.');
    }

    public function show(User $user)
    {
        // get a user record
        return response()->ok(UserResource::make(User::find($user->id)));
    }

    public function update(UserRequest $req, User $user)
    {
        // update user record
        User::find($user->id)->update($req->all());

        return response()->ok('User updated successfully.');
    }

    public function destroy(User $user)
    {
        // delete user record
        User::destroy($user->id);

        return response()->ok('User deleted successfully.');
    }
}