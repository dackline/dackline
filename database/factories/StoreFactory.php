<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_name' => $this->faker->words(3, true),
            'store_url' => $this->faker->randomElement(['http://test1.com', 'http://test2.com', 'http://test3.com']),
            'meta_title' => $this->faker->words(3, true),
            'meta_description' => $this->faker->paragraph(),
            'meta_keywords' => $this->faker->words(3, true),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'currency_id' => Currency::all()->random()->id,
            'country_id' => Country::all()->random()->id,
            'tax_id' => Tax::all()->random()->id,
            'default' => $this->faker->boolean(),
        ];
    }
}
