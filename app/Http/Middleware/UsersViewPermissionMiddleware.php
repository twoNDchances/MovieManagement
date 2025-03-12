<?php

namespace App\Http\Middleware;

use App\Models\PermissionManagements;
use App\Models\Permissions;
use App\Models\UserPermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersViewPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissionManagement = PermissionManagements::find(
            UserPermissions::find(
                Permissions::find(
                    $request->user()->permissions_id
                )->user_permissions_id
            )->permission_managements_id
        );
        if (!$permissionManagement->list || !$permissionManagement->view) {
            return response()->view('users_view', [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'permission' => false,
                'staticURL' => '-',
            ]);
        }
        return $next($request);
    }
}
