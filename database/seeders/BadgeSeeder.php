<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Badge::create([
            'title'=>'Best Seller',
            'icon_path'=>'https://cdn-icons-png.flaticon.com/128/7251/7251267.png',
            'description'=>'Most selling product'
        ]);

        Badge::create([
            'title'=>'Discount',
            'icon_path'=>'https://cdn-icons-png.flaticon.com/128/6136/6136996.png',
            'description'=>'50% discount'


        ]);

        Badge::create([
            'title'=>'favorite',
            'icon_path'=>'https://cdn-icons-png.flaticon.com/128/5406/5406792.png',
            'description'=>'most loved by the customer'

        ]);
    }
}
