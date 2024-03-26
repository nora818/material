<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function success($data = [], string $message = '', int $status = 0): JsonResponse
    {
        if ($message == '') {
            $message = "ok";
        }
        return response()->json([
            'code' => $status,
            'msg' => $message,
            'data' => $data
        ], 200);
    }


    public function error(string $message = 'error', int $status = 1): JsonResponse
    {
        if ($message == '') {
            $message = "fail";
        }
        return response()->json([
            'code' => $status,
            'msg' => $message,
            'data' => []
        ], 400);
    }
}
