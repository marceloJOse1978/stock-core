<?php

namespace Database\Factories;

use App\Models\Methods;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brands>
 */
class MethodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Methods::class;
    public function definition()
    {
        return [
            "title"=>fake()->title()
        ];
    }
}
