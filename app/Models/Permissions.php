<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $fillable = [
        "login",
        "movie_permissions_id",
        "user_permissions_id",
        "genre_permissions_id",
        "region_permissions_id",
        "actor_permissions_id",
        "login_permissions_id",
    ];

    public function moviePermissions()
    {
        return $this->belongsTo(MoviePermissions::class);
    }

    public function userPermissions()
    {
        return $this->belongsTo(UserPermissions::class);
    }

    public function genrePermissions()
    {
        return $this->belongsTo(GenrePermissions::class);
    }

    public function regionPermissions()
    {
        return $this->belongsTo(RegionPermissions::class);
    }

    public function actorPermissions()
    {
        return $this->belongsTo(ActorPermissions::class);
    }

    public function loginPermissions()
    {
        return $this->belongsTo(LoginPermissions::class);
    }
}
