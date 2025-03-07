<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    protected $fillable = [
        "regionName",
        'staticURL',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movies::class, 'movie_region');
    }
}
