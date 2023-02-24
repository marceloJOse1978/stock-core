<?php

namespace Database\Factories;

use App\Models\Providers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Providers>
 */
class ProvidersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Providers::class;
    public function definition()
    {
        return [
            "code"=>fake()->randomNumber(),
            "name"=>fake()->company(),
            "email"=>fake()->companyEmail(),
            "code_postal"=>fake()->countryCode(),
            "phone"=>fake()->phoneNumber(),
            "mobile"=>fake()->phoneNumber(),
            "city"=>fake()->city(),
            "address"=>fake()->address()
        ];
    }
}
