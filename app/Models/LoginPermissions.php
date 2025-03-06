<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginPermissions extends Model
{
    protected $fillable = [
        "disable",
        "enable",
    ];
}
