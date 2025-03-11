<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $fillable = [
        'movieName',
        'movieOriginName',
        'staticURL',
        'poster',
        'description',
        'annotation',
        'showtimes',
        'trailerURL',
        'duration',
        'currentOfEpisodes',
        'totalOfEpisodes',
        'releaseYear',
        'path',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genres::class, 'movie_genre');
    }

    public function regions()
    {
        return $this->belongsToMany(Regions::class, 'movie_region');
    }

    public function actors()
    {
        return $this->belongsToMany(Actors::class, 'movie_actor');
    }
}
