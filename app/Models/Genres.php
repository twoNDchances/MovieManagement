<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    protected $fillable = [
        "genreName",
        'staticURL',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'movie_genre');
    }
}
