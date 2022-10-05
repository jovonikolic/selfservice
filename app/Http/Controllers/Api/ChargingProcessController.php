<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChargeLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChargingProcessController extends Controller
{
    public function getChargeLogsByUserId(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $chargingProcesses = ChargeLog::query()->where("user_id", "=", $userId)->get(
            [
                "id",
                "start",
                "end",
                "kwh_start",
                "kwh_end",
                "invoiced"
            ]
        );

        return response()->json([
            'chargingProcesses' => $chargingProcesses
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
        return view('chargeLogs');
    }
}
