<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Check if the 'admin' role already exists, if not, create it
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        // Create the admin user (auto-incremented ID)
        $user = User::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '09690940143',
            'password' => Hash::make('111'),
            'role' => 'admin', // You may remove this if roles are managed via Spatie
            'active' => '1',
            'created_at' => now(),
            'verified' => true, // Set the user as verified
        ]);

        // Update the admin user's ID to 0 (after creation)
        $user->id = 0;
        $user->save();

        // Assign the 'admin' role to the user
        $user->assignRole('admin');

        // Reset auto-increment to start from 1 for new users
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");
    }
}
