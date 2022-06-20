<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'code' => $this->faker->word(),
            'symbol_left' => $this->faker->word(),
            'symbol_right' => $this->faker->word(),
            'decimal_places' => $this->faker->numberBetween(1, 4),
            'value' => $this->faker->randomFloat(4, 10, 100),
            'status' => $this->faker->randomElement([true, false]),
        ];
    }
}
