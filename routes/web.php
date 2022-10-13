<?php

use App\Http\Controllers\Api\ChargingProcessController;
use App\Http\Controllers\Api\ChargingStationController;
use App\Http\Controllers\Api\ErrorController;
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
    $userId = auth()->user()->id;        // gets the current user id

    $cp = DB::table('cps')            // fetches all stations with the corresponding user id
    ->where("user_id", "=", $userId)
        ->get();

    return view('dashboard', ['cp' => $cp, 'userId' => $userId]);
})->middleware(['auth'])->name('dashboard');

Route::get('/stations', [ChargingStationController::class, 'getStationsByUserId']);
Route::get('/chargelogs', [ChargingProcessController::class, 'getChargeLogsByUserId']);
Route::get('/errors', [ErrorController::class, 'getErrorsByUserId']);

Route::get('/chartErrors', [ErrorController::class, 'getErrorsTypes']);
Route::get('/solvedErrorsChart', [ErrorController::class, 'getSolvedErrors']);
Route::get('/errorOccurrence', [ErrorController::class, 'getErrorOccurrences']);

Route::get('/ChargingStations', [ChargingStationController::class, 'overview']);
Route::get('/ChargingProcesses', [ChargingProcessController::class, 'overview']);
Route::get('/Errors', [ErrorController::class, 'overview']);

Route::get('getErrorExport', [ErrorController::class, 'getErrorExport']);
