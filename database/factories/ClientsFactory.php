<?php

namespace Database\Factories;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clients>
 */
class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Clients::class;
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
