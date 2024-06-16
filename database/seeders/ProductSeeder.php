<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        ProductVariant::truncate();
        ProductGallery::truncate();
        DB::table('product_tag')->truncate();
        Product::truncate();
        ProductSize::truncate();
        ProductColor::truncate();
        Tag::truncate();

        Tag::factory(15)->create();

        foreach (['M', 'L', 'XL', 'S', 'XXL'] as $value) {
            ProductSize::query()->create([
                'name' => $value
            ]);
        }


        foreach (['#000000', '#00CCFF', '#00FF33', '#FFFF33', '#EE0000'] as $value) {
            ProductColor::query()->create([
                'name' => $value
            ]);
        }


        for ($i = 0; $i < 1000; $i++) {
            $name = fake()->text(100);

            Product::query()->create([
                'catelogue_id' => rand(1, 5),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'img_thumbnail' => 'https://canifa.com/img/500/750/resize/8/t/8tp24s004-sa422-thumb.webp',
                'price_regular' => 600000,
                'price_sale' => 480000,

            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/500/750/resize/8/t/8tp24s004-sa422-thumb.webp',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://canifa.com/img/500/750/resize/8/t/8tp24s001-sb001-thumb.webp',
                ]
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' =>rand(9, 15)
                ]
            ]);
        }

        for ($productId = 1; $productId < 1001; $productId++) {
            $data = [];
            for ($sizeId = 1; $sizeId < 6; $sizeId++) {
                for ($colorId = 1; $colorId < 6; $colorId++) {
                    $data[] = [
                        'product_id' => $productId,
                        'product_color_id' => $sizeId,
                        'product_size_id' => $colorId,
                        'quantity' => 100,
                        'image' => 'https://canifa.com/img/500/750/resize/8/t/8tp24s001-sb001-thumb.webp',
                    ];
                }
            }

            DB::table('product_variants')->insert($data);
        }


    }
}
