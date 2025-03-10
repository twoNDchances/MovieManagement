<?php

namespace App\Http\Controllers;

use App\Models\Actors;
use App\Models\Episodes;
use App\Models\Genres;
use App\Models\Movies;
use App\Models\Regions;
use App\Models\Servers;
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
            'genres' => Genres::all(),
            'regions' => Regions::all(),
            'actors' => Actors::all(),
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
            'genres' => 'nullable|array',
            'genres.*' => 'in:'.implode(',', Genres::pluck('id')->toArray()),
            'regions' => 'nullable|array',
            'regions.*' => 'in:'.implode(',', Regions::pluck('id')->toArray()),
            'actors' => 'nullable|array',
            'actors.*' => 'in:'.implode(',', Actors::pluck('id')->toArray()),
            'servers' => 'nullable|array',
            'servers.*.name' => 'required|string',
            'servers.*.episodes' => 'required|array',
            'servers.*.episodes.*.name' => 'required|string',
            'servers.*.episodes.*.slug' => 'required|string',
            'servers.*.episodes.*.video' => 'required|file|mimes:mp4',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $path = null;
        if ($request->hasFile('poster')) {
            $filename = time() . '_' . Str::uuid() . '.' . $request->file('poster')->extension();
            $path = '/uploads/posters/' . $filename;
            $request->file('poster')->move(public_path('uploads/posters'), $filename);
        }
        $movie = Movies::firstOrCreate([
            'movieName' => $request->movieName,
            'movieOriginName' => $request->movieOriginName,
            'staticURL' => Str::slug($request->staticURL),
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
        $movie->genres()->attach($request->genres);
        $movie->regions()->attach($request->regions);
        $movie->actors()->attach($request->actors);
        if ($request->has('servers')) {
            foreach ($request->input('servers') as $serverIndex => $server) {
                $serverInstance = Servers::create([
                    'serverName' => $server['name'],
                    'movies_id' => $movie->id,
                ]);
                foreach ($server['episodes'] as $episodeIndex => $episode) {
                    $videoPath = null;
                    if ($request->hasFile("servers.$serverIndex.episodes.$episodeIndex.video")) {
                        $videoFile = $request->file("servers.$serverIndex.episodes.$episodeIndex.video");
                        $filename = time() . '_' . Str::uuid() . '.' . $videoFile->extension();
                        $videoPath = '/uploads/videos/' . $filename;
                        $videoFile->move(public_path('uploads/videos'), $filename);
                    }
                    Episodes::create([
                        'episodeName' => $episode['name'],
                        'staticURL' => Str::slug($episode['slug']),
                        'path' => $videoPath,
                        'servers_id' => $serverInstance->id
                    ]);
                }
            }
        }
        return redirect()->route('movies.page');
    }

    public function getMoviesView(Request $request, $staticURL)
    {
        return view('movies_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'staticURL' => $staticURL,
        ]);
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
        $servers = $movie->servers;
        foreach ($servers as $server) {
            $episodes = Episodes::where('servers_id', $server->id)->get();
            foreach ($episodes as $episode) {
                $videoPath = public_path(ltrim($episode->path, '/'));
                if (file_exists($videoPath)) {
                    unlink($videoPath);
                }
            }
        }
        if (file_exists($posterPath)) {
            unlink($posterPath);
        }
        $movie->delete();
        return response()->json([
            'message' => 'Delete successfully',
        ]);
    }
}
