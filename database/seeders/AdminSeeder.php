<?php

namespace Database\Seeders; // Ensure the correct namespace

use Illuminate\Database\Seeder; // Import Seeder class
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Default admin password
            'is_admin' => true, // Assuming you have an `is_admin` field in users table
        ]);
    }
}
