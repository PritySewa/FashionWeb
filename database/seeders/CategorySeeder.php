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
            'images'=>'https://i.pinimgproxy.com/?url=aHR0cHM6Ly9jZG4taWNvbnMtcG5nLmZsYXRpY29uLmNvbS8yNTYvODgvODg3NzIucG5n&ts=1753441509&sig=78539a2234d055b2e145442b1ab8d1970f17126fd2c427a5cfd775a9f205d4e4',
            'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'T-Shirt',
         'images' => 'https://i.pinimgproxy.com/?url=aHR0cHM6Ly9jZG4taWNvbnMtcG5nLmZsYXRpY29uLmNvbS8yNTYvMTQ3NTgvMTQ3NTg5NDEucG5n&ts=1753441581&sig=ad95cf76322373508378e2720cee48bc97e2a434eeeddd3286c6fe8c0bb4945d',
        'status' => 'active',
        ]);
        Category::Create([
            'title' => 'Dress',
           'images'=>'https://i.pinimgproxy.com/?url=aHR0cHM6Ly9jZG4taWNvbnMtcG5nLmZsYXRpY29uLmNvbS8yNTYvMzA1My8zMDUzMDI3LnBuZw==&ts=1753441678&sig=227389b60853e00b4fa30c37bb9e58e34fc8dfe2768eb5b351777b7a03f2b241',
           'status' => 'inactive',
        ]);
        Category::Create([
            'title' => 'Jackets',
            'images'=>'https://i.pinimgproxy.com/?url=aHR0cHM6Ly9jZG4taWNvbnMtcG5nLmZsYXRpY29uLmNvbS8yNTYvMTAxNjkvMTAxNjk2NjUucG5n&ts=1753441709&sig=27b64b45551901d537f310594dbb465d21641e190f8774bdf8ff2db4e08fb627',
            'status' => 'inactive',
        ]);
    }
}
