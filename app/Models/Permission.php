<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Permission extends Model
{
    protected $fillable = [
        'key',
    ];

    public function roles(): MorphToMany
    {
        // Get the roles using Spatie's HasRoles trait relationship
        return $this->morphToMany(Role::class, 'permission', 'role_has_permissions', 'permission_id', 'role_id');
    }
}