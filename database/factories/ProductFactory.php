<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Product::class;
    public function definition()
    {
       
        return [
            "title"=>fake()->title(),
            'gross_price'=>fake()->randomNumber(),
            'description'=>fake()->text(),
            'variant_id'=>"1",
            'category_id'=>"1",
            'brand_id'=>"1", 
            'stock_type'=>"L", 
        ];
    }
}
