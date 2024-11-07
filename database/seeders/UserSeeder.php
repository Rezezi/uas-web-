<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminsuper1234'),
            'role' => 'admin', // Menetapkan role sebagai admin
        ]);

        // Membuat akun user biasa
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user1234'),
            'role' => 'user', // Role default sebagai user
        ]);
    }
}
