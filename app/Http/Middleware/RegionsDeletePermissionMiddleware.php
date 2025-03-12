<?php

namespace App\Http\Middleware;

use App\Models\PermissionManagements;
use App\Models\Permissions;
use App\Models\RegionPermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegionsDeletePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permissionManagement = PermissionManagements::find(
            RegionPermissions::find(
                Permissions::find(
                    $request->user()->permissions_id
                )->region_permissions_id
            )->permission_managements_id
        );
        if (!$permissionManagement->list || !$permissionManagement->view || !$permissionManagement->delete) {
            return response()->json([
                'message' => 'Your account don\'t have permission to perform this action.',
            ], 403);
        }
        return $next($request);
    }
}
