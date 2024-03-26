<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // 判断是No是 Web 请求
        if ($request->expectsJson()) {
            return response()->json([
                'code' => 401,
                'msg' => 'Unauthenticated'
            ], 401);
        }

        // 如果不是 Web 请求，则使用默认处理方法
        return redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    public function render($request, Throwable $e)
    {
        if ($request->is("api/*")) {
            if ($e instanceof ApiException) {
                $result = [
                    "code" => $e->getCode(),
                    "msg" => $e->getMessage()
                ];
                return response()->json($result, 500);
            }

            if ($e instanceof ValidationException) {
                $result = [
                    "code" => 10000,
                    "msg" => array_values($e->errors())[0][0]
                ];
                return response()->json($result, 400);
            }

            if (!env("APP_DEBUG")) {
                $result = [
                    "code" => 1,
                    "msg" => '内部错误, 请稍后重试'
                ];
                Log::error($e->getMessage());
                return response()->json($result, 500);
            }
        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
