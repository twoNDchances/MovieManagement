<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest.custom'])->group(function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin']);
});

Route::middleware(['auth.custom', 'login.permission'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard');

    Route::prefix('movies')->name('movies.')->group(function () {
        Route::get('', [MoviesController::class, 'getMovies'])->name('page');

        Route::middleware(['movies.add.permission'])->prefix('add')->name('add')->group(function () {
            Route::get('', [MoviesController::class, 'getMoviesAdd']);
            Route::post('', [MoviesController::class, 'postMoviesAdd']);
        });

        Route::middleware(['movies.list.permission'])->get('/list', [MoviesController::class, 'getMoviesList'])->name('list');
        
        Route::middleware(['movies.view.permission'])->get('/view/{staticURL}', [MoviesController::class, 'getMoviesView'])->name('view');
        Route::middleware(['movies.update.permission'])->patch('/update/{staticURL}', [MoviesController::class, 'patchMoviesUpdate'])->name('update');
        Route::middleware(['movies.delete.permission'])->delete('/delete/{staticURL}', [MoviesController::class, 'deleteMoviesDelete'])->name('delete');
    });

    Route::prefix('genres')->name('genres.')->group(function () {
        Route::get('', [GenresController::class, 'getGenres'])->name('page');

        Route::middleware(['genres.add.permission'])->prefix('add')->name('add')->group(function () {
            Route::get('', [GenresController::class, 'getGenresAdd']);
            Route::post('', [GenresController::class, 'postGenresAdd']);
        });

        Route::middleware(['genres.list.permission'])->get('/list', [GenresController::class, 'getGenresList'])->name('list');
        
        Route::middleware(['genres.view.permission'])->get('/view/{staticURL}', [GenresController::class, 'getGenresView'])->name('view');
        Route::middleware(['genres.update.permission'])->patch('/update/{staticURL}', [GenresController::class, 'patchGenresUpdate'])->name('update');
        Route::middleware(['genres.delete.permission'])->delete('/delete/{staticURL}', [GenresController::class, 'deleteGenresDelete'])->name('delete');
    });

    Route::prefix('regions')->name('regions.')->group(function () {
        Route::get('', [RegionsController::class, 'getRegions'])->name('page');

        Route::middleware(['regions.add.permission'])->prefix('add')->name('add')->group(function () {
            Route::get('', [RegionsController::class, 'getRegionsAdd']);
            Route::post('', [RegionsController::class, 'postRegionsAdd']);
        });

        Route::middleware(['regions.list.permission'])->get('/list', [RegionsController::class, 'getRegionsList'])->name('list');
        
        Route::middleware(['regions.view.permission'])->get('/view/{staticURL}', [RegionsController::class, 'getRegionsView'])->name('view');
        Route::middleware(['regions.update.permission'])->patch('/update/{staticURL}', [RegionsController::class, 'patchRegionsUpdate'])->name('update');
        Route::middleware(['regions.delete.permission'])->delete('/delete/{staticURL}', [RegionsController::class, 'deleteRegionsDelete'])->name('delete');
    });

    Route::prefix('actors')->name('actors.')->group(function () {
        Route::get('', [ActorsController::class, 'getActors'])->name('page');

        Route::middleware(['actors.add.permission'])->prefix('add')->name('add')->group(function () {
            Route::get('', [ActorsController::class, 'getActorsAdd']);
            Route::post('', [ActorsController::class, 'postActorsAdd']);
        });

        Route::middleware(['actors.list.permission'])->get('/list', [ActorsController::class, 'getActorsList'])->name('list');
        
        Route::middleware(['actors.view.permission'])->get('/view/{staticURL}', [ActorsController::class, 'getActorsView'])->name('view');
        Route::middleware(['actors.update.permission'])->patch('/update/{staticURL}', [ActorsController::class, 'patchActorsUpdate'])->name('update');
        Route::middleware(['actors.delete.permission'])->delete('/delete/{staticURL}', [ActorsController::class, 'deleteActorsDelete'])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UsersController::class, 'getUsers'])->name('page');

        Route::middleware(['users.add.permission'])->prefix('add')->name('add')->group(function () {
            Route::get('', [UsersController::class, 'getUsersAdd']);
            Route::post('', [UsersController::class, 'postUsersAdd']);
        });

        Route::middleware(['users.list.permission'])->get('/list', [UsersController::class, 'getUsersList'])->name('list');
        
        Route::middleware(['users.view.permission'])->get('/view/{email}', [UsersController::class, 'getUsersView'])->name('view');
        Route::middleware(['users.update.permission'])->patch('/update/{email}', [UsersController::class, 'patchUsersUpdate'])->name('update');
        Route::middleware(['users.delete.permission'])->delete('/delete/{email}', [UsersController::class, 'deleteUsersDelete'])->name('delete');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('', [ProfileController::class, 'getProfile'])->name('page');
        Route::patch('/update', [ProfileController::class, 'patchProfileUpdate'])->name('update');
    });
});

Route::middleware(['auth.custom'])->get('/logout', [LoginController::class, 'getLogout'])->name('logout');
