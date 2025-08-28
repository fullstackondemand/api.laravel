<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@laravel.com',
                'password' => 'password',
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@laravel.com',
                'password' => 'password',
            ]
        ]);

        $users->map(fn($item) => User::create($item));
    }
}