<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'balance' => 0,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa',
                'email' => 'user1@example.com',
                'balance' => 0,
                'password' => Hash::make('userpass1'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Premium',
                'email' => 'user2@example.com',
                'balance' => 0,
                'password' => Hash::make('userpass2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
