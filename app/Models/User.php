<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // create and delete user personal access token
    use HasApiTokens;

    // fill record only specific columns
    protected $fillable = ['name', 'username', 'email', 'password'];

    // define hide fields
    protected $hidden = ['password'];

    // define fields data type
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}