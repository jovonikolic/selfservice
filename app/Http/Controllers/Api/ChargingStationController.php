<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChargingStationController extends Controller
{
    public function getStationsByMandantId(Request $request): JsonResponse
    {
        $mandantId = auth()->user()->id;
        $cps = Cp::query()->where("mandant_id", "=", $mandantId)->get(
            [
                "id",
                "label",
                "public_display_name",
                "street",
                "city",
                "zip",
                "geo_long",
                "geo_lat",
                "serialnumber"
            ]
        );

        return response()->json([
            'cps' => $cps
        ]);
    }


    /**
     * Redirects to
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function overview(Request $request): Factory|View|Application
    {
        return view('stations');
    }
}
