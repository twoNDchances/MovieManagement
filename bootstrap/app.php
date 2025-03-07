<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\MoviesAddPermissionMiddleware;
use App\Http\Middleware\MoviesListPermissionMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.custom' => AuthMiddleware::class,
            'guest.custom' => GuestMiddleware::class,
            'login.permission' => LoginMiddleware::class,
            'movies.list.permission' => MoviesListPermissionMiddleware::class,
            'movies.add.permission' => MoviesAddPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
