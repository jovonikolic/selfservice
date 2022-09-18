<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CpResource;
use App\Models\Cp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChargingStationController extends Controller
{
    public function getStations() {
        $mandantId = auth()->user()->id;

        return DB::table('cps')
            ->where("mandant_id", "=", $mandantId)
            ->get();
    }
}
