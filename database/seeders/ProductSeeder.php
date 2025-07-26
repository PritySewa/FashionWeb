<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Purple Dress',
            'parent_id' => 1, // or set a valid parent product ID
            'category_id' => 1, // make sure this exists in your categories table
            'badge_id' => 1,// make sure this exists in your badges table
            'price' => '49.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/f4/e1/88/f4e1886e073cd7c4be3e9d81973d5828.jpg',
            // you can store this image in storage or public
            'description' => 'A beautiful purple dress perfect for summer events.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Made with cotton. Lightweight and breathable.',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],
        ]);
        Product::create([
            'title' => 'Leather Skirt',
            'parent_id' => 1, // or set a valid parent product ID
            'category_id' => 1, // make sure this exists in your categories table
            'badge_id' => 1, // make sure this exists in your badges table
            'price' => '50.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/81/7b/8a/817b8afbc235b36fb885583ae7cea588.jpg', // you can store this image in storage or public
            'description' => 'A classic skirt  perfect for every wear.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'tshirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '15.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/74/a0/94/74a094a81e18a39d5f2a3edba23cd2c5.jpg', // you can store this image in storage or public
            'description' => 'A classic  everyday wear.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'pink',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Jacket',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '55.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/5f/84/c0/5f84c0f92f050b97e2f60e7301d07949.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Bodycon',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '55.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/39/ad/3f/39ad3f611994de8ff662d3014c5054b4.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Formal Dress',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '55.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/5e/ed/a6/5eeda69019cc247b8be0d2cebb75a7e6.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Formal Pant',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '55.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'black',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
             Product::create([
                 'title' => 'Shirt',
                 'parent_id' => 2, // or set a valid parent product ID
                 'category_id' => 2, // make sure this exists in your categories table
                 'badge_id' => 2, // make sure this exists in your badges table
                 'price' => '55.99',
                 'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
                 'description' => 'perfect for winter.',
                 'stock' => '55',
                 'status' => 'active',
                 'is_variant' => 'no',
                 'size' => 'M',
                 'color' => 'White',
                 'specifications' => 'Cutton',
                 'image_urls' =>[
                     'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                     'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
                 ],

             ]);
        Product::create([
            'title' => 'Long Skirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '20.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'black',
            'specifications' => 'Stretchable',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Baggy Jeans',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '30.99',
            'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Blue',
            'specifications' => 'Hard',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Mini Skirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '45',
            'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Pink',
            'specifications' => 'cute',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);
        Product::create([
            'title' => 'Coat',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '100',
            'thumb_images_url' => 'https://i.pinimg.com/736x/28/68/0e/28680e346d7309ff141e20fc75e0814f.jpg', // you can store this image in storage or public
            'description' => 'perfect for winter.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Moron',
            'specifications' => 'Long and trendy',
            'image_urls' =>[
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_01_5.jpg',
                'https://cdn.panhomestores.com/cdn-cgi/image/width=627px,quality=60,%20format=auto,%20dpr=1/media/catalog/product/0/7/072GDB0800029_03_3.jpg',
            ],

        ]);


    }
}
