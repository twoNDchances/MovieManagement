<?php

namespace App\Providers;

use App\Models\ActorPermissions;
use App\Models\GenrePermissions;
use App\Models\LoginPermissions;
use App\Models\MoviePermissions;
use App\Models\PermissionManagements;
use App\Models\Permissions;
use App\Models\RegionPermissions;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole() && Schema::hasTable('users')) {
            $this->createDefaultAdmin();
        }
    }

    protected function createDefaultAdmin()
    {
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $generalPermission = [
                'add' => true,
                'view' => true,
                'list' => true,
                'update' => true,
                'delete' => true,
            ];
            $moviePermissionManagement = PermissionManagements::create($generalPermission);
            $userPermissionManagement = PermissionManagements::create($generalPermission);
            $genrePermissionManagement = PermissionManagements::create($generalPermission);
            $regionPermissionManagement = PermissionManagements::create($generalPermission);
            $actorPermissionManagement = PermissionManagements::create($generalPermission);
            $loginPermission = LoginPermissions::create([
                'disable' => true,
                'enable' => true,
            ]);
    
            $moviePermission = MoviePermissions::create([
                'permission_managements_id' => $moviePermissionManagement->id,
            ]);
            $userPermission = UserPermissions::create([
                'permission_managements_id' => $userPermissionManagement->id,
            ]);
            $genrePermission = GenrePermissions::create([
                'permission_managements_id' => $genrePermissionManagement->id,
            ]);
            $regionPermission = RegionPermissions::create([
                'permission_managements_id' => $regionPermissionManagement->id,
            ]);
            $actorPermission = ActorPermissions::create([
                'permission_managements_id' => $actorPermissionManagement->id,
            ]);
            
            $permission = Permissions::create([
                'login' => true,
                'movie_permissions_id' => $moviePermission->id,
                'user_permissions_id' => $userPermission->id,
                'genre_permissions_id' => $genrePermission->id,
                'region_permissions_id' => $regionPermission->id,
                'actor_permissions_id' => $actorPermission->id,
                'login_permissions_id' => $loginPermission->id,
            ]);
            User::create([
                'name' => 'DefaultAdmin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'permissions_id' => $permission->id,
            ]);
        }
    }
}
