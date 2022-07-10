<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name'
    ];

    public function rolePermissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function roleUsers()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function scopeWithName($query, $name)
    {
        return $name ? $query->where('display_name', 'like', '%' . $name . '%') : null;
    }

    public function attachPermission($permissionID)
    {
        return $this->rolePermissions()->attach($permissionID);
    }
    public function detachUser()
    {
        return $this->roleUsers()->detach();
    }

    public function detachPermission()
    {
        return $this->rolePermissions()->detach();
    }

    public function syncPermission($permissionId)
    {
        return $this->rolePermissions()->sync($permissionId);
    }
}
