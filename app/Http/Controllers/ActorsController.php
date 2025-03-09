<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function getActors(Request $request)
    {
        return view('actors_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
