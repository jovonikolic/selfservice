<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ErrorController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getErrorsByUserId(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $errors = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->select([
                "errors.id",
                "errors.code",
                "errors.info",
                "errors.cp_id",
                "errors.occurred",
                "errors.solved"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return response()->json([
            'errors' => $errors
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getErrorsTypes(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $errors = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->select([
                "errors.code",
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return response()->json([
            'errors' => $errors
        ]);
    }

    /**
     * Solved Errors chart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getSolvedErrors(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $unsolvedCount = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->select([
                "errors.solved"
            ])
            ->where('cps.user_id', '=', $userId)->get()->count();

        $solvedCount = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->where('cps.user_id', '=', $userId)
            ->where('errors.solved', '=', null)->count();

        return response()->json([
            'Unsolved' => $unsolvedCount,
            'Solved' => $solvedCount
        ]);
    }

    /**
     * Occurrence chart
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getErrorOccurrences(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $errors = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->select([
                "errors.occurred"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return response()->json([
            'errors' => $errors
        ]);
    }

    /**
     * Redirects to error page
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function overview(Request $request): Factory|View|Application
    {
        return view('errors');
    }

    /**
     * @param Request $request
     * @return string|null
     * @throws Exception
     */
    public function getErrorExport(Request $request): ?string
    {
        return view('charts/chartError');
    }

    /**
     * @param int|null $userId
     */
    public function getErrorsForCSVExport(int $userId = null): Collection
    {
        $errors = DB::table('errors')
            ->leftJoin('cps', 'errors.cp_id', '=', 'cps.id')
            ->select([
                "errors.id",
                "errors.code",
                "errors.info",
                "errors.cp_id",
                "errors.occurred",
                "errors.solved"
            ])
            ->where('cps.user_id', '=', $userId)->get();

        return $errors;
    }
}
