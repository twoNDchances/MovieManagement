<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $payload = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
        // dd($payload);
        return back()->withErrors([
            'message' => 'Can\'t login'
        ]);
    }
    
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
