<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permission = Permissions::find(Auth::user()->permissions_id);
        if (!$permission || !$permission->login) {
            return response(null, 403)->view('forbidden', [
                'message' => 'Your account was disabled.',
            ]);
        }
        return $next($request);
    }
}
