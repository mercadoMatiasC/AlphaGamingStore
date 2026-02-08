<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\EnsureUserIsActive;
use Infinitypaul\Idempotency\Middleware\EnsureIdempotency;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Aliases (ex middleware de ruta)
        $middleware->alias([
            'active' => EnsureUserIsActive::class,
            'role'   => EnsureUserHasRole::class,
            'idempotency' => EnsureIdempotency::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();