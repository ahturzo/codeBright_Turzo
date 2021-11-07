<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof TokenInvalidException)
        {
            return response()->json(['error' => 'Token is invalid'],400);
        }
        elseif($exception instanceof TokenExpiredException)
        {
            return response()->json(['error' => 'Token is expired'],400);
        }
        elseif($exception instanceof JWTException)
        {
            return response()->json(['error' => 'There is a problem with your Token'],400);
        }
        return parent::render($request, $exception);
    }
}
