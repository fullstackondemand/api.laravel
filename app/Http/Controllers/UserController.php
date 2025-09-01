<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $users = User::select()

            // search by name or email
            ->whereLike('name', "%{$req->search}%")
            ->orwhereLike('email', "%{$req->search}%")

            // sorting (default: id asc)
            ->orderBy($req->sort ?? 'id', $req->order ?? 'asc')

            // pagination (default: 10 1)
            ->paginate($req->limit ?? 10, page: $req->page ?? 1);

        // get all user records
        return response()->ok([
            'users' => UserResource::collection($users),
            'paginator' => collect($users)->only(['current_page', 'last_page', 'per_page', 'total'])
        ]);
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