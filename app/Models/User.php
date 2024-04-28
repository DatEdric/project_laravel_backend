<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;
use App\Models\Role;
use App\Models\Department;

class User extends Authenticatable
{
    use Notifiable, LaravelEntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // trạng thái tài khoản bị khóa
    const STATUS_LOCKED = 0;
    // trạng thái tài khoản hoạt động
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'name', 'password', 'email', 'phone', 'status', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
}
