<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cp;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChargingStationController extends Controller
{
    public function getStationsByUserId(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $cps = Cp::query()->where("user_id", "=", $userId)->get(
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

    public function getStationsForCSVExport($userId)
    {
        $cps = DB::table('cps')
            ->select([
                "cps.id",
                "cps.label",
                "cps.public_display_name",
                "cps.street",
                "cps.city",
                "cps.zip",
                "cps.geo_long",
                "cps.geo_lat",
                "cps.serialnumber"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return $cps;
    }
}
