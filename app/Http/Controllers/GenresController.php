<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GenresController extends Controller
{
    public function getGenres(Request $request)
    {
        return view('genres_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    public function getGenresList()
    {
        return response()->json([
            'genres' => Genres::all(),
        ]);
    }

    public function getGenresAdd(Request $request)
    {
        return view('genres_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
        ]);
    }

    public function postGenresAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'genreName' => 'required|unique:genres,genreName',
            'staticURL' => 'required|unique:genres,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        Genres::create([
            'genreName' => $request->genreName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('genres.page');
    }

    public function getGenresView(Request $request, $staticURL)
    {
        $genre = Genres::where('staticURL', $staticURL)->first();
        if (!$genre)
        {
            abort(404);
        }
        return view('genres_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'genreName' => $genre->genreName,
            'staticURL' => $genre->staticURL,
        ]);
    }

    public function patchGenresUpdate(Request $request, $staticURL)
    {
        $validator = Validator::make($request->all(), [
            'genreName' => 'required|unique:genres,genreName',
            'staticURL' => 'required|unique:genres,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $genre = Genres::where('staticURL', $staticURL)->first();
        if (!$genre)
        {
            abort(404);
        }
        $genre->update([
            'genreName' => $request->genreName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('genres.page');
    }

    public function deleteGenresDelete($staticURL)
    {
        $genre = Genres::where('staticURL', $staticURL)->first();
        if (!$genre)
        {
            return response()->json([
                'message' => $staticURL . ' not found'
            ], 404);
        }
        $genre->delete();
        return response()->json([
            'message' => 'Delete successfully'
        ]);
    }
}
