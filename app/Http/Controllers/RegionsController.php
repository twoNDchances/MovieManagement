<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function getRegions(Request $request)
    {
        return view('regions_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
