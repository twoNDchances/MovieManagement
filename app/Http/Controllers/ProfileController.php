<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        return view('profile', [
            'email' => $request->user()->email,
            'name' => $request->user()->name,
        ]);
    }

    public function patchProfileUpdate(Request $request)
    {
        $user = User::find($request->user()->id);
        $validator = Validator::make(array_filter($request->all()), [
            'name' => 'sometimes',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'currentPassword' => 'sometimes',
            'password' => 'sometimes|min:8'
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        if ($request->has('password'))
        {
            if (!$request->has('currentPassword'))
            {
                return back()->withErrors([
                    'currentPassword' => 'Current password is required.'
                ])->withInput();
            }
            if (!Hash::check($request->currentPassword, $user->password))
            {
                return back()->withErrors([
                    'currentPassword' => 'Current password is wrong'
                ])->withInput();
            }
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('profile.page');
    }
}
