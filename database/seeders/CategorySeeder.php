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
            'images'=>'https://i.pinimg.com/736x/52/46/a0/5246a06344af7be76769b086fb22ec98.jpg',
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'T-Shirt',
         'images' => 'https://i.pinimg.com/736x/51/17/40/51174036e7475da3b98f21c5a3604d7e.jpg',
        'status' => 'active',
        ]);
        Category::Create([
            'title' => 'Dress',
           'images'=>'https://i.pinimg.com/originals/72/7e/6a/727e6aaa19499582fe9240ab657ea523.png',
           'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'Jackets',
            'images'=>'https://i.pinimg.com/736x/f7/a1/c4/f7a1c480ffd71608cd59cd28205f42d9.jpg',
            'status' => 'inactive',
        ]);
    }
}
