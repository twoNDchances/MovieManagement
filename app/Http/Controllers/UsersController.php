<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers(Request $request)
    {
        return view('users_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }
}
