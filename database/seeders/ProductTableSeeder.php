<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
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
        $rates = [];
        for ($i = 0; $i < 100; $i++) {
            $products [] = [
                'name' => json_encode(['ar' => $faker_ar->name, 'en' => $faker->name] , JSON_UNESCAPED_UNICODE),
                'price_before_discount' => rand(20,50) ,
                'price_after_discount' => rand(1,1000) ,
                'image' => 'default.png' ,
                'quantity'   => rand(0,50),
                'category_id' => rand(1,40) ,
                'discount'    => rand(1,20),
                'best_selling'    => rand(0,1),
                'best_offer'    => rand(0,1),
                'description'    => json_encode(['ar' => $faker_ar->realText, 'en' => $faker->realText] , JSON_UNESCAPED_UNICODE),
                'created_at'     => $faker->dateTimeBetween($startDate = '-3 month',$endDate = 'now +6 month') ,

                'total_rate'     => rand(0,20)

            ];


            $rates [] = [
                'product_id'     => rand(1,99) ,
                'user_id'     => rand(1,99) ,
                'notes'         => $faker->realText ,
                'rate'       =>  rand(0,5) ,
                'created_at'     => $faker->dateTimeBetween($startDate = '-2 month',$endDate = 'now +4 month') ,


            ] ;
        }



        DB::table('products')->insert($products);
        DB::table('rates')->insert($rates);
    }
}
