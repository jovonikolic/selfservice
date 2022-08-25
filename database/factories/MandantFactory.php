<?php

namespace Database\Factories;

use App\Models\Mandant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @extends Factory<Mandant>
 */
class MandantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'uuid' => Uuid::uuid4()->toString(),
            'email' => fake()->email(),
            'username' => fake()->userName(),
            'password' => fake()->password(4, 6), // password
            'country_id' => fake()->numberBetween(2, 100),
            'street' => fake()->streetName(),
            'zip' => fake()->numberBetween(1010, 99999),
            'city' => fake()->city(),
            'vat' => fake()->iban()
        ];
    }
}
