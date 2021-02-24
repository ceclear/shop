<?php

namespace App\Exceptions;

use Exception;
use GenTux\Jwt\Exceptions\JwtException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof JwtException) return response()->json(['code' => 10000, 'message' => 'Jwt token不存在或出错']);
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('404');
        }
        if ($exception instanceof ValidationException) {
            $error = $exception->validator->errors()->first();
            if ($request->is("api/*")==false) {
                return parent::render($request, $exception);
            }
            return response()->json(['code' => 10000, 'message' => $error]);
        }
        if ($exception instanceof \BadMethodCallException) {
            if (preg_match("/^api\//", $request->path()) === false) {
                return parent::render($request, $exception);
            }
            return response()->json(['code' => 20000, 'message' => '方法不存在']);
        }
        return parent::render($request, $exception);
    }
}
