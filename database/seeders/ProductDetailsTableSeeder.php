<?php

namespace Database\Seeders;

use App\Helpers\Attachment;
use App\Models\ProductDetail;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker_ar = Faker::create('ar_JO');
        $products = [];
        for ($i = 0; $i < 100; $i++) {
            $products [] = [
                'color' => json_encode(['ar' => $faker_ar->colorName, 'en' => $faker->colorName], JSON_UNESCAPED_UNICODE),
                'product_id' => rand(1, 99),
            ];
        }

//       $record =  ProductDetail::insert($products);

        foreach ($products as $item){
            $record = ProductDetail::create([
                'color' => $item['color']  ,
                'product_id' => $item['product_id']  ,
            ]);

            Attachment::addAttachment('default.png', $record, 'product_details/product_details', ['save' => 'original']);

        }

    }
}
