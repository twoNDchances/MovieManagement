<?php

namespace App\Http\Middleware;

use App\Models\PermissionManagements;
use App\Models\Permissions;
use App\Models\UserPermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersUpdatePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $permission = Permissions::find($request->user()->permissions_id);
        $permissionManagement = PermissionManagements::find(
            UserPermissions::find(
                $permission->user_permissions_id
            )->permission_managements_id
        );
        if (!$permissionManagement->list || !$permissionManagement->view || !$permissionManagement->update) {
            return back()->withErrors([
                'alert' => 'Your account don\'t have permission to perform this action.',
            ])->withInput();
        }
        if ($request->has('others'))
        {
            // if (in_array('login', $request->others) && $request->email == $permission->user->email) {
            // {
            //     return back()->withErrors([
            //         'alert' => 'You can\'t ',
            //     ])->withInput();
            // }
            if (in_array('editLogin', $request->others) && !$permission->editLogin)
            {
                return back()->withErrors([
                    'alert' => 'Your account don\'t have permission to enable/disable login.',
                ])->withInput();
            }
        }
        return $next($request);
    }
}
