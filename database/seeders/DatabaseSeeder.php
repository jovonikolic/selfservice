<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ChargeLog;
use App\Models\Country;
use App\Models\Cp;
use App\Models\Error;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pathToDb = 'database/db.sql';
        DB::unprepared(file_get_contents($pathToDb));

        Country::factory(100)->create();
        // First create an admin user and then the others
        $admin = User::create([
            'name' => 'Admin',
            'uuid' => fake()->uuid(),
            'email' => 'admin@admin.at',
            'username' => 'Admin',
            'password' => Hash::make('admin'), // password
            'country_id' => fake()->numberBetween(2, 100),
            'street' => fake()->streetName(),
            'zip' => fake()->postcode(),
            'city' => fake()->city(),
            'vat' => fake()->iban()
        ]);
        event(new Registered($admin));
        Auth::login($admin);
        $users = User::factory(100)->create();
        foreach ($users as $user) {
            event(new Registered($user));
            Auth::login($user);
        }
        Cp::factory(1000)->create();
        ChargeLog::factory(7000)->create();
        Error::factory(10000)->create();
    }
}
