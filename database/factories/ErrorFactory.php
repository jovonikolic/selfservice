<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Error>
 */
class ErrorFactory extends Factory
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
            'code' => fake()->randomElement([
                'ConnectorLockFailure',
                'OtherError',
                'WeakSignal',
                'UnderVoltage',
                'OverVoltage',
            ]),
            'info' => fake()->randomElement([
                'Internal communications error',
                'Wiring issue',
                'Lock failed',
                'Cable error',
                'No info available',
            ]),
            'occurred' => fake()->dateTimeBetween('-2 years'),
            'solved' => fake()->randomElement([
                null,
                fake()->dateTimeBetween('-18 months')
            ]),
        ];
    }
}
