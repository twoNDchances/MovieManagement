<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorPermissions extends Model
{
    use HasFactory;
    protected $fillable = [
        "permission_managements_id",
    ];

    public function permissionManagements()
    {
        return $this->belongsTo(PermissionManagements::class);
    }
}
