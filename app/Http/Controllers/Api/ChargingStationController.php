<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChargingStationController extends Controller
{
    public function getStations(Request $request): JsonResponse
    {
        $mandantId = auth()->user()->id;
        $cps = Cp::query()->where("mandant_id", "=", $mandantId)->get();

        return response()->json([
            'cps' => $cps
        ]);
    }
}
