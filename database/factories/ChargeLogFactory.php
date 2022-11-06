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
            'start' => fake()->dateTimeBetween('-15 hours', '-7 hours'),
            'end' => fake()->dateTimeBetween('-6 hours', '+10 hours'),
            'consumption' => fake()->numberBetween(5, 80),
        ];
    }
}
