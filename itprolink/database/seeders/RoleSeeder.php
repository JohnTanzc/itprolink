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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'tutor']);
        Role::create(['name' => 'tutee']);

        // Find user by ID or any other criteria
        $user = User::find(1);

        // Assign a role to a user
        $user->assignRole('admin'); // or 'tutor', 'tutee'
    }
}
