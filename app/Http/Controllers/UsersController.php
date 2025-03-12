<?php

namespace App\Http\Controllers;

use App\Models\ActorPermissions;
use App\Models\GenrePermissions;
use App\Models\MoviePermissions;
use App\Models\PermissionManagements;
use App\Models\Permissions;
use App\Models\RegionPermissions;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function getUsers(Request $request)
    {
        return view('users_list', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
        ]);
    }

    public function getUsersList()
    {
        return response()->json([
            'users' => User::all(),
        ]);
    }

    public function getUsersAdd(Request $request)
    {
        return view('users_add', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
        ]);
    }

    public function postUsersAdd(Request $request)
    {
        $permissions = 'add,list,view,update,delete';
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:8',
            'movies' => 'nullable|array',
            'movies.*' => 'in:' . $permissions,
            'genres' => 'nullable|array',
            'genres.*' => 'in:' . $permissions,
            'regions' => 'nullable|array',
            'regions.*' => 'in:' . $permissions,
            'actors' => 'nullable|array',
            'actors.*' => 'in:' . $permissions,
            'users' => 'nullable|array',
            'users.*' => 'in:' . $permissions,
            'others' => 'nullable|array',
            'others.*' => 'in:login,editLogin',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $moviePermissionManagement = PermissionManagements::create($this->convert($request->movies));
        $genrePermissionManagement = PermissionManagements::create($this->convert($request->genres));
        $regionPermissionManagement = PermissionManagements::create($this->convert($request->regions));
        $actorPermissionManagement = PermissionManagements::create($this->convert($request->actors));
        $userPermissionManagement = PermissionManagements::create($this->convert($request->users));

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
            'login' => $this->convert($request->others, 'others')['login'],
            'editLogin' => $this->convert($request->others, 'others')['editLogin'],
            'movie_permissions_id' => $moviePermission->id,
            'user_permissions_id' => $userPermission->id,
            'genre_permissions_id' => $genrePermission->id,
            'region_permissions_id' => $regionPermission->id,
            'actor_permissions_id' => $actorPermission->id,
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'permissions_id' => $permission->id,
        ]);
        return redirect()->route('users.page');
    }

    public function getUsersView(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user)
        {
            abort(404);
        }
        $moviePermission = PermissionManagements::find(MoviePermissions::find(Permissions::find($user->permissions_id)->movie_permissions_id)->permission_managements_id);
        $genrePermission = PermissionManagements::find(GenrePermissions::find(Permissions::find($user->permissions_id)->genre_permissions_id)->permission_managements_id);
        $regionPermission = PermissionManagements::find(RegionPermissions::find(Permissions::find($user->permissions_id)->region_permissions_id)->permission_managements_id);
        $actorPermission = PermissionManagements::find(ActorPermissions::find(Permissions::find($user->permissions_id)->actor_permissions_id)->permission_managements_id);
        $userPermission = PermissionManagements::find(UserPermissions::find(Permissions::find($user->permissions_id)->user_permissions_id)->permission_managements_id);
        $otherPermission = Permissions::find($user->permissions_id);
        return view('users_view', [
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'permission' => true,
            'user' => $user,
            'moviePermission' => $moviePermission,
            'genrePermission' => $genrePermission,
            'regionPermission' => $regionPermission,
            'actorPermission' => $actorPermission,
            'userPermission' => $userPermission,
            'otherPermission' => $otherPermission,
        ]);
    }

    public function patchUsersUpdate(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user)
        {
            abort(404);
        }
        $permissions = 'add,list,view,update,delete';
        $validator = Validator::make(array_filter($request->all()), [
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'name' => 'sometimes',
            'password' => 'sometimes|min:8',
            'movies' => 'sometimes|array',
            'movies.*' => 'in:' . $permissions,
            'genres' => 'sometimes|array',
            'genres.*' => 'in:' . $permissions,
            'regions' => 'sometimes|array',
            'regions.*' => 'in:' . $permissions,
            'actors' => 'sometimes|array',
            'actors.*' => 'in:' . $permissions,
            'users' => 'sometimes|array',
            'users.*' => 'in:' . $permissions,
            'others' => 'sometimes|array',
            'others.*' => 'in:login,editLogin',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $moviePermission = PermissionManagements::find(MoviePermissions::find(Permissions::find($user->permissions_id)->movie_permissions_id)->permission_managements_id);
        $genrePermission = PermissionManagements::find(GenrePermissions::find(Permissions::find($user->permissions_id)->genre_permissions_id)->permission_managements_id);
        $regionPermission = PermissionManagements::find(RegionPermissions::find(Permissions::find($user->permissions_id)->region_permissions_id)->permission_managements_id);
        $actorPermission = PermissionManagements::find(ActorPermissions::find(Permissions::find($user->permissions_id)->actor_permissions_id)->permission_managements_id);
        $userPermission = PermissionManagements::find(UserPermissions::find(Permissions::find($user->permissions_id)->user_permissions_id)->permission_managements_id);
        $otherPermission = Permissions::find($user->permissions_id);
        $payload = [
            'email' => $request->email,
            'name' => $request->name,
        ];
        if ($request->has('password'))
        {
            if (!is_null($request->password) || Str::length($request->password) !== 0)
            {
                $payload['password'] = bcrypt($request->password);
            }
        }
        $user->update(array_filter($payload));
        $moviePermission->update($this->convert($request->movies));
        $genrePermission->update($this->convert($request->genres));
        $regionPermission->update($this->convert($request->regions));
        $actorPermission->update($this->convert($request->actors));
        $userPermission->update($this->convert($request->users));
        $otherPermission->update($this->convert($request->others, 'others'));
        return redirect()->route('users.page');
    }

    public function deleteUsersDelete(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        if (!$user)
        {
            abort(404);
        }
        if ($email == $request->user()->email)
        {
            return response()->json([
                'message' => 'You can\'t delete yourself',
            ], 403);
        }
        $moviePermission = PermissionManagements::find(MoviePermissions::find(Permissions::find($user->permissions_id)->movie_permissions_id)->permission_managements_id);
        $genrePermission = PermissionManagements::find(GenrePermissions::find(Permissions::find($user->permissions_id)->genre_permissions_id)->permission_managements_id);
        $regionPermission = PermissionManagements::find(RegionPermissions::find(Permissions::find($user->permissions_id)->region_permissions_id)->permission_managements_id);
        $actorPermission = PermissionManagements::find(ActorPermissions::find(Permissions::find($user->permissions_id)->actor_permissions_id)->permission_managements_id);
        $userPermission = PermissionManagements::find(UserPermissions::find(Permissions::find($user->permissions_id)->user_permissions_id)->permission_managements_id);
        $moviePermission->delete();
        $genrePermission->delete();
        $regionPermission->delete();
        $actorPermission->delete();
        $userPermission->delete();
        return response()->json([
            'message' => 'Delete successfully',
        ]);
    }

    private function convert($data, $mode = 'general')
    {
        $finalArray = [
            'add' => false,
            'list' => false,
            'view' => false,
            'update' => false,
            'delete' => false,
        ];
        if (is_array($data)) {
            if ($mode == 'general') {
                foreach ($data as $value) {
                    if (in_array($value, ['add', 'list', 'view', 'update', 'delete'])) {
                        $finalArray[$value] = true;
                    }
                }
            } else if ($mode == 'others') {
                $finalArray = [
                    'login' => false,
                    'editLogin' => false,
                ];
                foreach ($data as $value) {
                    if (in_array($value, ['login', 'editLogin'])) {
                        $finalArray[$value] = true;
                    }
                }
            }
        }
        return $finalArray;
    }
}
