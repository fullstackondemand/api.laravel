<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // create and delete user personal access token
    use HasApiTokens;

    // define not added fields
    protected $guarded = ['password_confirmation'];

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