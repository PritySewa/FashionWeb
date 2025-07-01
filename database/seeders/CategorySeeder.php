<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::Create([
            'title' => 'Pant',
            'description' => 'Includes Different types of pant',
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'T-Shirt',
            'description' => 'Different types of tops',
            'status' => 'active',
        ]);
        Category::Create([
            'title' => 'Dress',
            'description' => 'Includes Different types of dress ',
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'Jackets',
            'description' => 'Includes Different types of jackets',
            'status' => 'inactive',
        ]);
    }
}
