<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionManagements extends Model
{
    protected $fillable = [
        "add",
        "view",
        "list",
        "update",
        "delete",
    ];
}
