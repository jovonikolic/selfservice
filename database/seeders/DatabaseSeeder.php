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
        Mandant::factory(100)->create();
        Cp::factory(100)->create();
        ChargeLog::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
