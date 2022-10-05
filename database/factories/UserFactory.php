<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
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
            'password' => Hash::make('asdfasdf'), // password
            'country_id' => fake()->numberBetween(2, 100),
            'street' => fake()->streetName(),
            'zip' => fake()->numberBetween(1010, 99999),
            'city' => fake()->city(),
            'vat' => fake()->iban()
        ];
    }
}
