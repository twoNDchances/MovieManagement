<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MoviesController extends Controller
{
    public function getMovies(Request $request)
    {
        return view('movies_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
    public function getMoviesList()
    {
        $movies = Movies::all();
        return response()->json([
            'movies' => $movies,
        ]);
    }

    public function getMoviesAdd(Request $request)
    {
        return view('movies_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
        ]);
    }

    public function postMoviesAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movieName' => 'required|unique:movies,movieName',
            'movieOriginName' => 'required|unique:movies,movieOriginName',
            'staticURL' => 'required|unique:movies,staticURL',
            'poster' => 'required|image',
            'trailer' => 'nullable|url',
            'currentOfEpisodes' => 'nullable|integer',
            'totalOfEpisodes' => 'nullable|integer',
            'releaseYear' => 'nullable|integer',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $path = null;
        if ($request->hasFile('poster')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('poster')->extension();
            $path = 'uploads/' . $filename;
            $request->file('poster')->move(public_path('uploads'), $filename);
        }
        Movies::firstOrCreate([
            'movieName' => $request->movieName,
            'movieOriginName' => $request->movieOriginName,
            'staticURL' => $request->staticURL,
            'poster' => $path,
            'description' => $request->description,
            'annotation' => $request->annotation,
            'showtimes' => $request->showtimes,
            'trailerURL' => $request->trailer,
            'duration' => $request->duration,
            'currentOfEpisodes' => $request->currentOfEpisodes,
            'totalOfEpisodes' => $request->totalOfEpisodes,
            'releaseYear' => $request->releasYear,
        ]);
        return response($request->all());
    }
}
