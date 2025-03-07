<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    protected $fillable = [
        "serverName",
        'movies_id',
    ];

    public function movies()
    {
        return $this->belongsTo(Movies::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }
}
