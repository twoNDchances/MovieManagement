<?php

use App\Http\Middleware\ActorsAddPermissionMiddleware;
use App\Http\Middleware\ActorsDeletePermissionMiddleware;
use App\Http\Middleware\ActorsListPermissionMiddleware;
use App\Http\Middleware\ActorsUpdatePermissionMiddleware;
use App\Http\Middleware\ActorsViewPermissionMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GenresAddPermissionMiddleware;
use App\Http\Middleware\GenresDeletePermissionMiddleware;
use App\Http\Middleware\GenresListPermissionMiddleware;
use App\Http\Middleware\GenresUpdatePermissionMiddleware;
use App\Http\Middleware\GenresViewPermissionMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\MoviesAddPermissionMiddleware;
use App\Http\Middleware\MoviesDeletePermissionMiddleware;
use App\Http\Middleware\MoviesListPermissionMiddleware;
use App\Http\Middleware\MoviesUpdatePermissionMiddleware;
use App\Http\Middleware\MoviesViewPermissionMiddleware;
use App\Http\Middleware\RegionsAddPermissionMiddleware;
use App\Http\Middleware\RegionsDeletePermissionMiddleware;
use App\Http\Middleware\RegionsListPermissionMiddleware;
use App\Http\Middleware\RegionsUpdatePermissionMiddleware;
use App\Http\Middleware\RegionsViewPermissionMiddleware;
use App\Http\Middleware\UsersAddPermissionMiddleware;
use App\Http\Middleware\UsersDeletePermissionMiddleware;
use App\Http\Middleware\UsersListPermissionMiddleware;
use App\Http\Middleware\UsersUpdatePermissionMiddleware;
use App\Http\Middleware\UsersViewPermissionMiddleware;
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
            'movies.add.permission' => MoviesAddPermissionMiddleware::class,
            'movies.list.permission' => MoviesListPermissionMiddleware::class,
            'movies.view.permission' => MoviesViewPermissionMiddleware::class,
            'movies.update.permission' => MoviesUpdatePermissionMiddleware::class,
            'movies.delete.permission' => MoviesDeletePermissionMiddleware::class,
            'genres.add.permission' => GenresAddPermissionMiddleware::class,
            'genres.list.permission' => GenresListPermissionMiddleware::class,
            'genres.view.permission' => GenresViewPermissionMiddleware::class,
            'genres.update.permission' => GenresUpdatePermissionMiddleware::class,
            'genres.delete.permission' => GenresDeletePermissionMiddleware::class,
            'regions.add.permission' => RegionsAddPermissionMiddleware::class,
            'regions.list.permission' => RegionsListPermissionMiddleware::class,
            'regions.view.permission' => RegionsViewPermissionMiddleware::class,
            'regions.update.permission' => RegionsUpdatePermissionMiddleware::class,
            'regions.delete.permission' => RegionsDeletePermissionMiddleware::class,
            'actors.add.permission' => ActorsAddPermissionMiddleware::class,
            'actors.list.permission' => ActorsListPermissionMiddleware::class,
            'actors.view.permission' => ActorsViewPermissionMiddleware::class,
            'actors.update.permission' => ActorsUpdatePermissionMiddleware::class,
            'actors.delete.permission' => ActorsDeletePermissionMiddleware::class,
            'users.add.permission' => UsersAddPermissionMiddleware::class,
            'users.list.permission' => UsersListPermissionMiddleware::class,
            'users.view.permission' => UsersViewPermissionMiddleware::class,
            'users.update.permission' => UsersUpdatePermissionMiddleware::class,
            'users.delete.permission' => UsersDeletePermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
