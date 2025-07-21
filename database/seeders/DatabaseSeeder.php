<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(ProductSeeder::class);

        $this->call(AboutUsSeeder::class);
        $this->call(HomeDesignSeeder::class);




    }
}
