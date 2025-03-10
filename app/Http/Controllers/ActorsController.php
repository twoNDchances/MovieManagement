<?php

namespace App\Http\Controllers;

use App\Models\Actors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ActorsController extends Controller
{
    public function getActors(Request $request)
    {
        return view('actors_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    public function getActorsList()
    {
        return response()->json([
            'actors' => Actors::all(),
        ]);
    }

    public function getActorsAdd(Request $request)
    {
        return view('actors_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
        ]);
    }

    public function postActorsAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'actorName' => 'required|unique:actors,actorName',
            'staticURL' => 'required|unique:actors,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        Actors::create([
            'actorName' => $request->actorName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('actors.page');
    }

    public function getActorsView(Request $request, $staticURL)
    {
        $actor = Actors::where('staticURL', $staticURL)->first();
        if (!$actor)
        {
            abort(404);
        }
        return view('actors_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'actorName' => $actor->actorName,
            'staticURL' => $actor->staticURL,
        ]);
    }

    public function patchActorsUpdate(Request $request, $staticURL)
    {
        $validator = Validator::make($request->all(), [
            'actorName' => 'required|unique:actors,actorName',
            'staticURL' => 'required|unique:actors,staticURL',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $actor = Actors::where('staticURL', $staticURL)->first();
        if (!$actor)
        {
            abort(404);
        }
        $actor->update([
            'actorName' => $request->actorName,
            'staticURL' => Str::slug($request->staticURL),
        ]);
        return redirect()->route('actors.page');
    }

    public function deleteActorsDelete($staticURL)
    {
        $actor = Actors::where('staticURL', $staticURL)->first();
        if (!$actor)
        {
            return response()->json([
                'message' => $staticURL . ' not found'
            ], 404);
        }
        $actor->delete();
        return response()->json([
            'message' => 'Delete successfully'
        ]);
    }
}
