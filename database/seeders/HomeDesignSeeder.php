<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\Home;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            'title'=>'PrettyAura',
            'image'=>'https://i.pinimg.com/736x/bd/86/49/bd8649071b6da9cd947b4e6110746cbb.jpg',
            'description'=>'Discover trendy outfits, stylish accessories, and must-have beauty essentials – all in one place. Whether you are dressing up for a party or keeping it casual, we have got something just for you. Shop your style, express your vibe!',
        'phone_no'=>'9816738245',
    'address'=>'Pokhara, Nepal',
            'email'=>'Shopping1@gmail.com'
]);


        Home::create([
            'title'=>'AimOnYou',
            'image'=>'https://i.pinimg.com/736x/84/42/81/84428138e3cf04a32c8bab66cd948518.jpg',
            'description' => 'Step into the spotlight with AimOnYou — your go-to destination for bold fashion, bestselling styles, and accessories that turn heads. Be confident. Be iconic.',
            'phone_no'=>'9816737897',
            'address'=>'Kathmandu, Nepal',
            'email'=>'prettyAura@gmail.com'
        ]);



    }

}
