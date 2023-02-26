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
        Providers::factory(1)->create();
        Clients::factory(1)->create();

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
