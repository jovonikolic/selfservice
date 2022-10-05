<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cp>
 */
class CpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => fake()->slug(2),
            'user_id' => fake()->numberBetween(2, 100),
            'country_id' => fake()->numberBetween(2, 100),
            'active' => fake()->numberBetween(0, 1),
            'public_display_name' => fake()->words(3, true),
            'geo_long' => fake()->randomFloat(),
            'geo_lat' => fake()->randomFloat(),
            'street' => fake()->streetName(),
            'zip' => fake()->postcode(),
            'city' => fake()->city(),
            'serialnumber' => fake()->numberBetween(1523458, 47091936),
            'firmwareversion' => fake()->numberBetween(1523458, 47091936),
        ];
    }
}
