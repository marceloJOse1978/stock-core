<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Setting::class;
    public function definition()
    {
       
        return [
            "name_bs"=>fake()->title(),
            'nif'=>fake()->randomNumber(9),
            'address_bs'=>fake()->address(),
            'phone_bs'=>fake()->phoneNumber(),
            'iban_1'=>"AO06 XXXX XXXX XXX XXX",
            'account_1'=>"XXXX XXXX XXXX XX",
            'iban_2'=>"AO06 XXXX XXXX XXX XXX",
            'account_2'=>"AO06 XXXX XXXX XXX XXX"
        ];
    }
}
