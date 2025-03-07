<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    protected $fillable = [
        "episodeName",
        'staticURL',
        'link',
        'servers_id'
    ];

    public function servers()
    {
        return $this->belongsTo(Servers::class);
    } 
}
