<?php

namespace App\Http\Controllers\API\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data, int $code = 200): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    public function error($message, int $code): JsonResponse
    {
        return response()->json(['message' => $message], $code);
    }
}
