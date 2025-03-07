<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function getMoviesList(Request $request)
    {
        $movies = Movies::all();
        return view('movies_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'movies' => $movies,
        ]);
    }

    public function getMoviesAdd(Request $request)
    {
        return view('movies_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    public function postMoviesAdd(Request $request)
    {
        return redirect()->route('movies.add');
    }
}
