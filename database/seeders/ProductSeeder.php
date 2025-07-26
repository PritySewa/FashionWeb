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
            'title' => 'Ruffled Hem',
            'parent_id' => 1, // or set a valid parent product ID
            'category_id' => 3, // make sure this exists in your categories table
            'badge_id' => 1,// make sure this exists in your badges table
            'price' => '2500',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/104f0168-308e-4787-b868-36860a5207c6.jpg?imageView2/2/w/800/q/70/format/webp',
            // you can store this image in storage or public
            'description' => 'A beautiful dress perfect for summer events.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Made with cotton. Lightweight and breathable.',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/8121dc7b-3f90-4c08-a4d1-57b2a07778a1.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/5bb08339-1244-4951-ae76-4b1067bca41b.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/54569706-5550-43fb-844a-54691f369ccc.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),
        ]);
        Product::create([
            'title' => 'drawstrings Side Skirt ',
            'parent_id' => 1, // or set a valid parent product ID
            'category_id' => 5, // make sure this exists in your categories table
            'badge_id' => 1, // make sure this exists in your badges table
            'price' => '2000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/cc80efe1-24d9-4fe5-8529-b0bbd29ff8c5.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'High Waist, Non-Stretch Polyester, Machine Washable.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/d3fbf383-a1b1-465b-a774-ac2a0dec606f.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/fb153651-0e12-4b70-9b08-126d6d83174c.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Off-Shoulder shirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '1500',
            'thumb_images_url' => 'https://img.kwcdn.com/product/2013f777728/7ffd6ce1-6557-4a5a-9381-7f068a022dd0_1340x1787.png?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Women Solid Color Off-Shoulder Bell Sleeve Asymmetrical Elegant T-Shirt.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'XL',
            'color' => 'pink',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/2013f777728/74e6af56-beea-4faf-936a-50c77a62bc42_1340x1787.png?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/df759b1d-3f33-4825-a7ce-a15bdf3ea573.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/df759b1d-3f33-4825-a7ce-a15bdf3ea573.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Hooded Jacket',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 4, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '3000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/3ac6d4a2-8b93-4398-9c67-f79fcf672ed4.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Faux Fur Trim, Plush Thick Warmth, Adjustable Belt, Multiple Pockets, Machine Washable, Soft Comfort Lining.',
            'stock' => '50',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/6bdc6ff5-a35a-4d7f-a922-36dd9b71777d.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/4533330f-bf9a-4d73-9280-83d4a52ce202.jpg?imageView2/2/w/800/q/70/format/webp',

            ]),

        ]);
        Product::create([
            'title' => 'Ruffle Slit Mesh Dress',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 3, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '4000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/72fc5278-f80b-4ff7-b4aa-623c139d6797.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Asymmetrical Hem, Fitted Silhouette with Thigh-High Slit, Machine Washable All-Season Formal & Casual Wear.',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'L',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/e856a531-b5ce-4107-8e5e-312af7186ec1.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/e856a531-b5ce-4107-8e5e-312af7186ec1.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/cb05a698-2a66-4b9f-910b-2e00c9aa8a0b.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Floral Print Corset Top',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '1500',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/fa25bfbf-6c7d-4e87-885f-491ab759f395.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Shoulder Strapless Design with Lace Trim & Ruffled Sleeves, High Support Front Button',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'S',
            'color' => 'Purple',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/275328f7-0e36-4ac6-8c03-2001ad5c5d23.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/57f92d68-9ae0-4d12-9d24-30fb85a9949d.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/f60315b9-5445-4242-b63c-34a7675782fa.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Embroidered Flare Jeans',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 1, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '2000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/9e83a54c-50d6-4add-851c-29a0f461557b.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Rise Bell Bottom Denim Pants, Blue with White Floral Patterns, Blend, Machine Washable, Casual Wear Jeans',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'L',
            'color' => 'black',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/c1305833-df10-437b-8747-a6f145a80fa5.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/d385e66c-c874-4f36-afd6-4c2b0e6fc1b4.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
             Product::create([
                 'title' => 'Flared Pant',
                 'parent_id' => 2, // or set a valid parent product ID
                 'category_id' => 1, // make sure this exists in your categories table
                 'badge_id' => 2, // make sure this exists in your badges table
                 'price' => '2000',
                 'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/e131bb0a-678c-495a-8b80-a82563467158.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
                 'description' => 'Elegant Loose Fit, Breathable Fabric, Solid Color with Decorative Buttons, Perfect for Spring/Summer/Fall,.',
                 'stock' => '55',
                 'status' => 'active',
                 'is_variant' => 'no',
                 'size' => 'M',
                 'color' => 'White',
                 'specifications' => 'Cutton',
                 'image_urls' => json_encode([
                     'https://img.kwcdn.com/product/fancy/d6e5553c-9f34-4fda-b4fc-4314bd4a42d9.jpg?imageView2/2/w/800/q/70/format/webp',
                     'https://img.kwcdn.com/product/fancy/84cedc54-b906-43d0-ab59-840fbf37dd78.jpg?imageView2/2/w/800/q/70/format/webp',
                     'https://img.kwcdn.com/product/fancy/51f0002b-a4b0-44a2-8dae-9f272a38264b.jpg?imageView2/2/w/800/q/70/format/webp',
                 ]),

             ]);
        Product::create([
            'title' => 'Winter Jacket with Hood',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 2, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '4000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/e6e7c27a-a0e8-4948-b338-86ecece0b668.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Lightweight Windproof Outerwear, Full-Zip Closure, Lavender Cold-Weather Coat',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'XL',
            'color' => 'black',
            'specifications' => 'Stretchable',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/e6e7c27a-a0e8-4948-b338-86ecece0b668.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/e81e8af9-c37b-42f4-b8ea-b27676f88fe3.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/28fe5ef3-27e8-4bd0-9319-730d2a433efa.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Ruffled Hem Skirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 5, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '2000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/58039903-2d5b-4ad5-ad7e-58250adc3d6c.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'High-Waisted Asymmetrical Skirt with Side Slit, Lightweight Polyester for Spring/Summer Casual & Vacation Wear',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Blue',
            'specifications' => 'Hard',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/52e9b39f-417a-4a11-b81a-9a1e2c782291.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/0cc3fec9-23c5-4846-a505-af57d9258fff.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/1d15a52a-1794-4d97-b266-a0bb7843cbc4.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Ruffled Hem Skirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 5, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '600',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/0cc3fec9-23c5-4846-a505-af57d9258fff.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'High-Waisted Asymmetrical Skirt with Side Slit, Lightweight Polyester for Spring/Summer Casual & Vacation Wear',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'L',
            'color' => 'Pink',
            'specifications' => 'cute',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/1d15a52a-1794-4d97-b266-a0bb7843cbc4.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
                'https://img.kwcdn.com/product/fancy/0cc3fec9-23c5-4846-a505-af57d9258fff.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);
        Product::create([
            'title' => 'Brown Jacket',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 4, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '100',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/market/398d21c50ae36d027763ca1178d45baf_cStlwlRQyFFDx.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Casual Zip-Up Crop Top with Multiple Pockets, Long Sleeves, and Adjustable Collar for Casual Attire',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Moron',
            'specifications' => 'Long and trendy',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/b03b940e-bdfd-4114-adf4-eef4aa265384.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/5d564539-47a0-41c8-8757-4ce86110aa08.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/e9f568ae-37eb-443b-94c4-99eeb72a949f.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);

        Product::create([
            'title' => 'Lace-Up Crop Shirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 3, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '1800',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/5162193c-b4b5-4e43-8788-fb9d02092fcf.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Floral Print Bell Sleeve, Long Sleeve Lettuce Trim Lace-Up Slim Fit Crop Top',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'XL',
            'color' => 'Moron',
            'specifications' => 'Long and trendy',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/1f301869-77f7-4e7e-86c0-4a0f5c3f463f.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/eee8c6bd-0141-40fd-8e81-11923b93f61b.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/16ac78e7-ebaa-4037-925e-ca5c59990e52.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);

        Product::create([
            'title' => 'Stretchy Denim Jeans',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 1, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '5500',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/06638f28-1ae1-44ed-a164-2d3190a2e7ea.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Flared Leg with Red Cross Embellishments, Machine Washable All-Season Casual Pants',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'M',
            'color' => 'Moron',
            'specifications' => 'Long and trendy',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/f764bac9-bff3-421c-99bf-6f446282d495.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/eb06a2ef-a4a2-4f5e-b62a-0400ead4952e.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/fd1cf959-cc4f-4ad4-bbdf-d66232a6edda.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);

        Product::create([
            'title' => 'Flared Blue skirt',
            'parent_id' => 2, // or set a valid parent product ID
            'category_id' => 5, // make sure this exists in your categories table
            'badge_id' => 2, // make sure this exists in your badges table
            'price' => '3000',
            'thumb_images_url' => 'https://img.kwcdn.com/product/fancy/a8daa2fa-d228-4f6c-ac0d-9fb1b6262756.jpg?imageView2/2/w/800/q/70/format/webp', // you can store this image in storage or public
            'description' => 'Machine Washable Tiered hem, Structured Non-Fraying denim for Formal/Casual Outfits',
            'stock' => '55',
            'status' => 'active',
            'is_variant' => 'no',
            'size' => 'X',
            'color' => 'Moron',
            'specifications' => 'Long and trendy',
            'image_urls' => json_encode([
                'https://img.kwcdn.com/product/fancy/14f625eb-1a12-46bd-b6b5-c81cd7115bb5.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/06121465-13fb-4cc2-bc49-d3019ec37656.jpg?imageView2/2/w/800/q/70/format/webp',
                'https://img.kwcdn.com/product/fancy/9d9be8a5-e51a-4f81-a119-b04a269a10f0.jpg?imageView2/2/w/800/q/70/format/webp',
            ]),

        ]);


    }
}
