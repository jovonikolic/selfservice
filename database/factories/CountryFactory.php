<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
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
            'name' => fake()->country(),
            'country_short' => fake()->countryCode(),
            'continent' => fake()->slug(1),
            'capital' => fake()->city(),
            'telephone_prefix' => '+' . fake()->numberBetween(1, 999),
            'tax_percent' => fake()->numberBetween(0, 30),
        ];
    }
}
