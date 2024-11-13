<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Make sure to import the User model

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin already exists to avoid duplicate users
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Look for an admin with this email
            [
                'fname' => 'Admin',          // Admin's first name
                'lname' => 'User',            // Admin's last name
                'email' => 'admin@gmail.com',    // Admin's email address
                'password' => Hash::make('111'), // Admin's password (hashed)
                'role' => 'admin',               // Set the role as 'admin'
                'active' => 1,                   // Mark the user as active
                'created_at' => now(),           // Set the creation time
            ]
        );
    }
}
