<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ChargeLog;
use App\Models\Country;
use App\Models\Cp;
use App\Models\Mandant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        Mandant::factory()->create([
            'name' => 'Admin',
            'uuid' => fake()->uuid(),
            'username' => 'Admin',
            'password' => 'admin', // password
            'country_id' => fake()->numberBetween(2, 100),
            'street' => fake()->streetName(),
            'zip' => fake()->numberBetween(1010, 99999),
            'city' => fake()->city(),
            'vat' => fake()->iban()
        ]);
        Mandant::factory(100)->create();
        Cp::factory(100)->create();
        ChargeLog::factory(100)->create();
    }
}
