<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles if they don't already exist
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin', 'guard_name' => 'web']);
        }
        if (!Role::where('name', 'tutor')->exists()) {
            Role::create(['name' => 'tutor', 'guard_name' => 'web']);
        }
        if (!Role::where('name', 'tutee')->exists()) {
            Role::create(['name' => 'tutee', 'guard_name' => 'web']);
        }

        // Ensure the user exists before assigning roles
        $user = User::find(1); // Replace with your desired user ID or criteria

        if ($user) {
            // Check if the 'admin' role exists and assign it to the user if needed
            if (!$user->hasRole('admin')) {
                $user->assignRole('admin'); // Change to 'tutor' or 'tutee' if needed
            }
        } else {
            $this->command->warn("User with ID 1 does not exist. Role not assigned.");
        }
    }
}

