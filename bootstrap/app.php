<?php

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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'is_set_role' => \App\Http\Middleware\IsSetRole::class,
            'redirect_if_role_set' => \App\Http\Middleware\RedirectIfRoleSet::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'vehicle_owner' => \App\Http\Middleware\VehicleOwnerMiddleware::class,
            'workshop' => \App\Http\Middleware\WorkshopMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
