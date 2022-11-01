<?php

namespace Database\Factories;

use App\Models\ChargeLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChargeLog>
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
            'cp_id' => fake()->numberBetween(2, 999),
            'invoiced' => fake()->numberBetween(0, 1),
            'uuid' => fake()->uuid(),
            'start' => fake()->dateTimeBetween('-8 hours', 'now'),
            'end' => fake()->dateTimeBetween('+1 hour', '+8 hours'),
            'kwh_start' => fake()->numberBetween(0, 999999999),
            'kwh_end' => fake()->numberBetween(70, 99999999),
        ];
    }
}
