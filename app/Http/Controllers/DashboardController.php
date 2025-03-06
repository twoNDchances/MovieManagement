<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        return view('dashboard', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
