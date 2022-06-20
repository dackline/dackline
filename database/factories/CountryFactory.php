<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'iso_code_2' => $this->faker->word(),
            'iso_code_3' => $this->faker->word(),
            'postcode_required' => $this->faker->randomElement([true, false]),
            'status' => $this->faker->randomElement([true, false]),
        ];
    }
}
