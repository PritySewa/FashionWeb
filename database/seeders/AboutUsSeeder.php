<?php

namespace Database\Seeders;
use App\Models\AboutUs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder // ✅ Renamed to avoid conflict
{
    public function run(): void
{
    AboutUs::create([
        'name' => 'PrettyAura',
        'introduction' => 'Your go-to fashion destination',
        'description' => 'PrettyAura brings you the latest in fashion trends, curated just for you. From everyday essentials to head-turning outfits, we’re here to elevate your wardrobe.',
        'features' => 'Trendy Styles, Fast Delivery, Affordable Prices, Easy Returns',
        'images' => 'https://i.pinimg.com/736x/c5/73/40/c5734050b4b946cbf3528c1a3be89093.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
}
