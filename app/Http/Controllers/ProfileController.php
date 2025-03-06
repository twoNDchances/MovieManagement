<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        return view('profile', [
            'email' => $request->user()->email,
            'name' => $request->user()->name,
        ]);
    }
}
