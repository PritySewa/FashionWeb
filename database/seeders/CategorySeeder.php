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
            'images' => 'images/pant.png',  // path relative to public/
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'T-Shirt',
            'images' => 'images/shirt.png',  // path relative to public/
        'status' => 'active',
        ]);
        Category::Create([
            'title' => 'Dress',
            'images' => 'images/dress.png',  // path relative to public/
           'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'Jackets',
            'images' => 'images/jacket.png',  // path relative to public/
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'Skirt',
            'images' => 'images/skirt.png',  // path relative to public/
            'status' => 'inactive',
        ]);
    }
}
