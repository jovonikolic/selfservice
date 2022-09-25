<?php

use App\Http\Controllers\Api\ChargingStationController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $mandantId = auth()->user()->id;        // gets the current mandant id

    $cp = DB::table('cps')            // fetches all stations with the corresponding mandant id
    ->where("mandant_id", "=", $mandantId)
        ->get();

    return view('dashboard', ['cp' => $cp, 'mandantId' => $mandantId]);
})->middleware(['auth'])->name('dashboard');

Route::get('/stations', [ChargingStationController::class, 'getStationsByMandantId']);

Route::get('/ChargingStations', [ChargingStationController::class, 'overview']);
