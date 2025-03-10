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
        
        Route::middleware([])->get('/view/{staticURL}', [MoviesController::class, 'getMoviesView'])->name('view');
        
        Route::middleware([])->prefix('update')->name('update')->group(function () {
            Route::get('/{staticURL}', [MoviesController::class, '']);
            Route::patch('', [MoviesController::class, '']);
        });

        Route::middleware([])->delete('/delete/{staticURL}', [MoviesController::class, 'deleteMoviesDelete'])->name('delete');
    });

    Route::prefix('genres')->name('genres.')->group(function () {
        Route::get('', [GenresController::class, 'getGenres'])->name('page');

        Route::middleware([])->prefix('add')->name('add')->group(function () {
            Route::get('', [GenresController::class, 'getGenresAdd']);
            Route::post('', [GenresController::class, 'postGenresAdd']);
        });

        Route::middleware([])->get('/list', [GenresController::class, 'getGenresList'])->name('list');
        
        Route::middleware([])->get('/view/{staticURL}', [GenresController::class, 'getGenresView'])->name('view');
        Route::middleware([])->patch('/update/{staticURL}', [GenresController::class, 'patchGenresUpdate'])->name('update');
        Route::middleware([])->delete('/delete/{staticURL}', [GenresController::class, 'deleteGenresDelete'])->name('delete');
    });

    Route::prefix('regions')->name('regions.')->group(function () {
        Route::get('', [RegionsController::class, 'getRegions'])->name('page');

        Route::middleware([])->prefix('add')->name('add')->group(function () {
            Route::get('', [RegionsController::class, 'getRegionsAdd']);
            Route::post('', [RegionsController::class, 'postRegionsAdd']);
        });

        Route::middleware([])->get('/list', [RegionsController::class, 'getRegionsList'])->name('list');
        
        Route::middleware([])->get('/view/{staticURL}', [RegionsController::class, 'getRegionsView'])->name('view');
        Route::middleware([])->patch('/update/{staticURL}', [RegionsController::class, 'patchRegionsUpdate'])->name('update');
        Route::middleware([])->delete('/delete/{staticURL}', [RegionsController::class, 'deleteRegionsDelete'])->name('delete');
    });

    Route::prefix('actors')->name('actors.')->group(function () {
        Route::get('', [ActorsController::class, 'getActors'])->name('page');

        Route::middleware([])->prefix('add')->name('add')->group(function () {
            Route::get('', [ActorsController::class, 'getActorsAdd']);
            Route::post('', [ActorsController::class, 'postActorsAdd']);
        });

        Route::middleware([])->get('/list', [ActorsController::class, 'getActorsList'])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [ActorsController::class, 'getActorsView'])->name('view');
        Route::middleware([])->patch('/update/{staticURL}', [ActorsController::class, 'patchActorsUpdate'])->name('update');
        Route::middleware([])->delete('/delete/{staticURL}', [ActorsController::class, 'deleteActorsDelete'])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UsersController::class, 'getUsers'])->name('page');

        Route::middleware([])->get('/add', [])->name('add');
        Route::middleware([])->get('/list', [])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        Route::middleware([])->get('/update/{staticURL}', [])->name('update');
        Route::middleware([])->get('/delete/{staticURL}', [])->name('delete');
    });

    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
});

Route::middleware(['auth.custom'])->get('/logout', [LoginController::class, 'getLogout'])->name('logout');
