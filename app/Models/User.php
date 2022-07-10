<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userRoles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * Scope a query to only include name users.
     *
     */
    public function scopeSearchWithName($query, $name)
    {
        return $name ? $query->where('name', 'like', '%' . $name . '%') : null;
    }

    /**
     * Scope a query to only include email users.
     *
     */
    public function scopeSearchWithEmail($query, $email)
    {
        return $email ? $query->where('email', 'like', '%' . $email . '%') : null;
    }

    /**
     * Scope a query to only include roleId users.
     *
     */
    public function scopeSearchWithRoleId($query, $roleId)
    {
        return $roleId ? $query->WhereHas('userRoles', function ($q) use ($roleId) {
            $q->where('roles.id', $roleId);
        }) : null;
    }

    public function attachRole($roleId)
    {
        return $this->userRoles()->attach($roleId);
    }

    public function syncRole($roleId)
    {
        return $this->userRoles()->sync($roleId);
    }

    public function detachRole()
    {
        return $this->userRoles()->detach();
    }

    public function getRole($id)
    {
        return $this->userRoles()->where('user_id', $id)->pluck('role_id');
    }

    public function hasPermission($permission)
    {
        foreach ($this->userRoles as $role) {
            if ($role->rolePermissions->contains('name', $permission)) {
                return true;
            }
        }
    }

    public function hasRole($role)
    {
        return $this->userRoles->contains('name', $role);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }
}
