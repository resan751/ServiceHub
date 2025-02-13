<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       user::create([
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => 'admin123',
        'role' => 'admin'
       ]);
       user::create([
        'username' => 'resan',
        'email' => 'resansaputra2@gmail.com',
        'password' => '157751',
        'role' => 'user'
       ]);
    }
}
