<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Error;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ErrorController extends Controller
{
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
     * Redirects to
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function overview(Request $request): Factory|View|Application
    {
        return view('errors');
    }
}
