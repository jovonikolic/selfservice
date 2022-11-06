<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChargeLog;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ChargingProcessController extends Controller
{
    public function getChargeLogsByUserId(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select([
                "charge_logs.id",
                "charge_logs.cp_id",
                "charge_logs.start",
                "charge_logs.end",
                "charge_logs.consumption",
                "charge_logs.invoiced"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return response()->json([
            'chargingProcesses' => $chargingProcesses
        ]);
    }

    /**
     * @param int|null $userId
     * @return Collection
     */
    public function getChargeLogsForCSVExport(int $userId = null): Collection
    {
        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select([
                "charge_logs.id",
                "charge_logs.cp_id",
                "charge_logs.start",
                "charge_logs.end",
                "charge_logs.consumption",
                "charge_logs.invoiced"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return $chargingProcesses;
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

    public function analyzeChargingTimeline(): Factory|View|Application
    {
        return view('charts/chartChargingProcess');
    }

    public function getDataForChargingProcessAnalytics()
    {
        $userId = auth()->user()->id;
        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)->get();

        return $chargingProcesses;
    }
}
