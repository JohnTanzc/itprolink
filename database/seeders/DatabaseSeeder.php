<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // First, seed the roles
        $this->call(RoleSeeder::class);

        // Then, seed the admin user (and other users if needed)
        $this->call(AdminUserSeeder::class);
    }
}
