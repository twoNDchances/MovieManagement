<?php

namespace App\Http\Controllers;

use App\Models\Actors;
use App\Models\Genres;
use App\Models\Movies;
use App\Models\Regions;
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
        return response()->json([
            'movies' => Movies::all(),
        ]);
    }

    public function getMoviesAdd(Request $request)
    {
        return view('movies_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'genres' => Genres::all(),
            'regions' => Regions::all(),
            'actors' => Actors::all(),
        ]);
    }

    public function postMoviesVideo(Request $request)
    {

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
            'genres' => 'nullable|array',
            'genres.*' => 'in:'.implode(',', Genres::pluck('id')->toArray()),
            'regions' => 'nullable|array',
            'regions.*' => 'in:'.implode(',', Regions::pluck('id')->toArray()),
            'actors' => 'nullable|array',
            'actors.*' => 'in:'.implode(',', Actors::pluck('id')->toArray()),
            'video' => 'required|file|mimes:mp4',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('poster')->extension();
            $posterPath = '/uploads/posters/' . $filename;
            $request->file('poster')->move(public_path('uploads/posters'), $filename);
        }
        $videoPath = null;
        if ($request->hasFile('video')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('video')->extension();
            $videoPath = '/uploads/videos/' . $filename;
            $request->file('video')->move(public_path('uploads/videos'), $filename);
        }
        $movie = Movies::create([
            'movieName' => $request->movieName,
            'movieOriginName' => $request->movieOriginName,
            'staticURL' => Str::slug($request->staticURL),
            'poster' => $posterPath,
            'description' => $request->description,
            'annotation' => $request->annotation,
            'showtimes' => $request->showtimes,
            'trailerURL' => $request->trailer,
            'duration' => $request->duration,
            'currentOfEpisodes' => $request->currentOfEpisodes,
            'totalOfEpisodes' => $request->totalOfEpisodes,
            'releaseYear' => $request->releaseYear,
            'path' => $videoPath,
        ]);
        $movie->genres()->attach($request->genres);
        $movie->regions()->attach($request->regions);
        $movie->actors()->attach($request->actors);
        return redirect()->route('movies.page');
    }

    public function getMoviesView(Request $request, $staticURL)
    {
        $movie = Movies::where('staticURL', $staticURL)->first();
        if (!$movie)
        {
            abort(404);
        }
        return view('movies_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'staticURL' => $staticURL,
            'movie' => $movie,
            'genres' => Genres::all(),
            'regions' => Regions::all(),
            'actors' => Actors::all(),
            'genresChecked' => $movie->genres()->pluck('genres.id')->toArray(),
            'regionsChecked' => $movie->regions()->pluck('regions.id')->toArray(),
            'actorsChecked' => $movie->actors()->pluck('actors.id')->toArray(),
        ]);
    }

    public function patchMoviesUpdate(Request $request, $staticURL)
    {
        $movie = Movies::where('staticURL', $staticURL)->first();
        if (!$movie)
        {
            abort(404);
        }
        $validator = Validator::make(array_filter($request->all()), [
            'movieName' => 'sometimes|unique:movies,movieName,'.$movie->id,
            'movieOriginName' => 'sometimes|unique:movies,movieOriginName,'.$movie->id,
            'staticURL' => 'sometimes|unique:movies,staticURL,'.$movie->id,
            'poster' => 'sometimes|image',
            'trailer' => 'sometimes|url',
            'currentOfEpisodes' => 'sometimes|integer',
            'totalOfEpisodes' => 'sometimes|integer',
            'releaseYear' => 'sometimes|integer',
            'genres' => 'sometimes|array',
            'genres.*' => 'in:'.implode(',', Genres::pluck('id')->toArray()),
            'regions' => 'sometimes|array',
            'regions.*' => 'in:'.implode(',', Regions::pluck('id')->toArray()),
            'actors' => 'sometimes|array',
            'actors.*' => 'in:'.implode(',', Actors::pluck('id')->toArray()),
            'video' => 'sometimes|file|mimes:mp4',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('poster')->extension();
            $posterPath = '/uploads/posters/' . $filename;
            $request->file('poster')->move(public_path('uploads/posters'), $filename);
            $oldPosterPath = public_path(ltrim($movie->poster, '/'));
            if (file_exists($oldPosterPath)) {
                unlink($oldPosterPath);
            }
        }
        $videoPath = null;
        if ($request->hasFile('video')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('video')->extension();
            $videoPath = '/uploads/videos/' . $filename;
            $request->file('video')->move(public_path('uploads/videos'), $filename);
            $oldVideoPath = public_path(ltrim($movie->path, '/'));
            if (file_exists($oldVideoPath)) {
                unlink($oldVideoPath);
            }
        }
        $movie->update(array_filter([
            'movieName' => $request->movieName,
            'movieOriginName' => $request->movieOriginName,
            'staticURL' => Str::slug($request->staticURL),
            'poster' => $posterPath,
            'description' => $request->description,
            'annotation' => $request->annotation,
            'showtimes' => $request->showtimes,
            'trailerURL' => $request->trailer,
            'duration' => $request->duration,
            'currentOfEpisodes' => $request->currentOfEpisodes,
            'totalOfEpisodes' => $request->totalOfEpisodes,
            'releaseYear' => $request->releaseYear,
            'path' => $videoPath,
        ]));
        $movie->genres()->sync($request->genres);
        $movie->regions()->sync($request->regions);
        $movie->actors()->sync($request->actors);
        return redirect()->route('movies.page');
    }

    public function deleteMoviesDelete($staticURL)
    {
        $movie = Movies::where('staticURL', $staticURL)->first();
        if (!$movie)
        {
            return response()->json([
                'message' => $staticURL . ' not found',
            ], 404);
        }
        $posterPath = public_path(ltrim($movie->poster, '/'));
        if (file_exists($posterPath)) {
            unlink($posterPath);
        }
        $videoPath = public_path(ltrim($movie->path, '/'));
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }
        $movie->delete();
        return response()->json([
            'message' => 'Delete successfully',
        ]);
    }
}
