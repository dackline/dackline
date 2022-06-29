<?php

namespace Database\Factories;

use App\Models\GeoZone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tax_name' => $this->faker->word(),
            'tax_rate' => $this->faker->randomFloat(2, 5, 50),
            'type' => $this->faker->randomElement(['fixed_amount', 'percentage']),
            'geo_zone_id' => GeoZone::all()->random()->id,
            'status' => $this->faker->randomElement([1, 0]),
        ];
    }
}
