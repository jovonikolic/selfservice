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
            'start' => fake()->dateTimeBetween('-13 day -9 hours', '-13 day -2 hours'),
            'end' => fake()->dateTimeBetween('-13 day +3 hours', '-13 day +16 hours'),
            'consumption' => fake()->numberBetween(5, 80),
        ];
    }
}
