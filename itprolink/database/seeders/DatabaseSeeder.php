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
        // Uncomment or add other seeders you want to run
        $this->call(AdminUserSeeder::class);

        // You can add more seeders here as needed
        // $this->call(ProductTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
    }
}
