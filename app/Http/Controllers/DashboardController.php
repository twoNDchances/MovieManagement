<?php

namespace App\Http\Controllers;

use App\Models\Actors;
use App\Models\Genres;
use App\Models\Movies;
use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        return view('dashboard', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'movieLength' => count(Movies::all()),
            'genreLength' => count(Genres::all()),
            'regionLength' => count(Regions::all()),
            'actorLength' => count(Actors::all()),
        ]);
    }
}
