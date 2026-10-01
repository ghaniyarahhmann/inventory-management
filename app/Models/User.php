<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * User belongs to one department.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * User can have many roles.
     */
    public function roles()
{
    return $this->belongsToMany(Role::class);
}

    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check whether the user has a specific permission
     * through any of their roles.
     */
    public function hasPermission($permission)
{
    return $this->roles()
        ->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })
        ->exists();
}
}