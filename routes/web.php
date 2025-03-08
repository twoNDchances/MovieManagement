<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ProfileController;
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
        
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        
        Route::middleware([])->prefix('update')->name('update')->group(function () {
            Route::get('/{staticURL}', [MoviesController::class, '']);
            Route::patch('', [MoviesController::class, '']);
        });

        Route::middleware([])->delete('/delete/{staticURL}', [])->name('delete');
    });

    Route::prefix('genres')->name('genres.')->group(function () {
        Route::get('', [])->name('page');

        Route::middleware([])->get('/add', [])->name('add');
        Route::middleware([])->get('/list', [])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        Route::middleware([])->get('/update/{staticURL}', [])->name('update');
        Route::middleware([])->get('/delete/{staticURL}', [])->name('delete');
    });

    Route::prefix('regions')->name('regions.')->group(function () {
        Route::get('', [])->name('page');

        Route::middleware([])->get('/add', [])->name('add');
        Route::middleware([])->get('/list', [])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        Route::middleware([])->get('/update/{staticURL}', [])->name('update');
        Route::middleware([])->get('/delete/{staticURL}', [])->name('delete');
    });

    Route::prefix('actors')->name('actors.')->group(function () {
        Route::get('', [])->name('page');

        Route::middleware([])->get('/add', [])->name('add');
        Route::middleware([])->get('/list', [])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        Route::middleware([])->get('/update/{staticURL}', [])->name('update');
        Route::middleware([])->get('/delete/{staticURL}', [])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [])->name('page');

        Route::middleware([])->get('/add', [])->name('add');
        Route::middleware([])->get('/list', [])->name('list');
        Route::middleware([])->get('/view/{staticURL}', [])->name('view');
        Route::middleware([])->get('/update/{staticURL}', [])->name('update');
        Route::middleware([])->get('/delete/{staticURL}', [])->name('delete');
    });

    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('profile');
});

Route::middleware(['auth.custom'])->get('/logout', [LoginController::class, 'getLogout'])->name('logout');
