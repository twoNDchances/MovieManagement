<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    protected $fillable = [
        "actorName",
        'staticURL',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'movie_actor');
    }
}
