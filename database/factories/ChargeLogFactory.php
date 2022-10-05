<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChargeLog>
 */
class ChargeLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cp_id' => fake()->numberBetween(2, 100),
            'user_id' => fake()->numberBetween(3, 100),
            'invoiced' => fake()->numberBetween(0, 1),
            'uuid' => fake()->uuid(),
            'start' => fake()->dateTimeBetween('-2 years'),
            'end' => fake()->dateTimeBetween('-1 year 11 months'),
            'kwh_start' => fake()->numberBetween(0, 999999999),
            'kwh_end' => fake()->numberBetween(70, 99999999),
        ];
    }
}
