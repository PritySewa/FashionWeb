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
            'icon_image'=>'badge1.jpeg',
            'description'=>'Most selling product'
        ]);

        Badge::create([
            'title'=>'Discount',
            'icon_image'=>'badge2.jpeg',
            'description'=>'50% discount'


        ]);

        Badge::create([
            'title'=>'favorite',
            'icon_image'=>'badge3.jpeg',
            'description'=>'most loved by the customer'

        ]);
    }
}
