<?php

namespace App\Http\Middleware;

use App\Models\GenrePermissions;
use App\Models\PermissionManagements;
use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenresUpdatePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissionManagement = PermissionManagements::find(
            GenrePermissions::find(
                Permissions::find(
                    $request->user()->permissions_id
                )->genre_permissions_id
            )->permission_managements_id
        );
        if (!$permissionManagement->list || !$permissionManagement->view || !$permissionManagement->update) {
            return back()->withErrors([
                'alert' => 'Your account don\'t have permission to perform this action.',
            ])->withInput();
        }
        return $next($request);
    }
}
