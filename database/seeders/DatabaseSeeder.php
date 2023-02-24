<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Clients;
use App\Models\Methods;
use App\Models\Product;
use App\Models\Providers;
use App\Models\Setting;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Brands::factory(1)->createMany(array(
            ["title"=>"HP"],
            ["title"=>"ASUS"],
            ["title"=>"IPAD"]
        ));
        Variant::factory(1)->createMany([
            ["title"=>"AZUL"],
            ["title"=>"PRETO"],
            ["title"=>"BRANCO"]
        ]);
        Type::factory(1)->createMany([
            ["title"=>"BEBIDA"],
            ["title"=>"SERVIÇOS-REDES"],
            ["title"=>"PC"]
        ]);
        Methods::factory(1)->createMany([
            ["title"=>"CASH"],
            ["title"=>"BANCO"]
        ]);
        Providers::factory(3)->create();
        Clients::factory(3)->create();
        Product::factory(1)->createMany([
            [
                "title"=>"PC GAMER",
                'gross_price'=>"100000",
                'unit_id'=>"1",
                'variant_id'=>"1",
                'category_id'=>"3",
                'brand_id'=>"1", 
                'stock_type'=>"L", 
            ],
            [
                "title"=>"AMBERNIC",
                'gross_price'=>"35000",
                'unit_id'=>"1",
                'variant_id'=>"1",
                'category_id'=>"3",
                'brand_id'=>"1", 
                'stock_type'=>"L", 
            ]
        ]);

        User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
        ]);
        Unit::factory()->createMany([
            ["title"=>"Uni"],
            ["title"=>"Kg"]
        ]);
    }
}
