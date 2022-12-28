<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * @param int $userId
     * @return Collection
     */
    public function getChargeLogsForCSVExport(int $userId): Collection
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

    public function weeklyChargingProcessAnalytics(): Factory|View|Application
    {
        return view('charts/weeklyChargingData');
    }

    public function getDataForChargingProcessAnalytics(): Collection
    {
        $userId = auth()->user()->id;
        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)
            ->whereDate("charge_logs.start", "=", date("2022-11-15"))->get(); // filter by date

        return $chargingProcesses;
    }


    public function getWeeklyChargingProcessData(): Collection
    {
        $userId = auth()->user()->id;

        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)
            ->whereDate("charge_logs.start", ">=", date("2022-11-21"))
            ->whereDate("charge_logs.start", "<=", date("2022-11-27"))
            ->get(); // filter by date

        return $chargingProcesses;
    }

    public function getMonthlyChargingProcessData(): Collection
    {
        $userId = auth()->user()->id;

        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)
            ->whereDate("charge_logs.start", ">=", date("2022-11-01"))
            ->whereDate("charge_logs.start", "<=", date("2022-11-30"))
            ->get(); // filter by date

        return $chargingProcesses;
    }

    public function getLatestChargingProcess(): Collection
    {
        $userId = auth()->user()->id;

        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)
            ->orderBy("charge_logs.start", "desc")
            ->limit(1)->get();

        return $chargingProcesses;
    }

    public function getWeeklyData(Request $request): ?Collection
    {
        $week = $request->header('week');
        if (!$week) {
            return null;
        }
        $userId = auth()->user()->id;

        $firstDay = date("Y-m-d", strtotime("2022W$week"));
        $lastDay = strtotime($firstDay);
        $lastDay = strtotime("+6 day", $lastDay);
        $lastDay = date("Y-m-d", $lastDay);

        $chargingProcesses = DB::table('charge_logs')
            ->leftJoin('cps', 'charge_logs.cp_id', '=', 'cps.id')
            ->select(
                "charge_logs.consumption",
                "charge_logs.start",
                "charge_logs.end"
            )
            ->where('cps.user_id', '=', $userId)
            ->whereDate("charge_logs.start", ">=", $firstDay)
            ->whereDate("charge_logs.start", "<=", $lastDay)
            ->get(); // filter by date

        return $chargingProcesses;
    }
}
