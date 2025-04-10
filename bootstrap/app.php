<?php

use App\Http\Middleware\AppMiddleware;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Middleware\TokenValidator;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(AppMiddleware::class);
        // $middleware->append(TokenValidator::class);
        $middleware->alias([
            'token_validator' => TokenValidator::class,
            'prevent_back' => RevalidateBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();