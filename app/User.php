<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name','last_name', 'email', 'password', 'state',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
    public function auspices()
    {
        return $this->hasMany(Auspice::class);
    }
    public function institutionals()
    {
        return $this->hasMany(Institutional::class);
    }
    public function presenters()
    {
        return $this->hasMany(Presenter::class);
    }
    public function program()
    {
        return $this->hasMany(Program::class);
    }
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
    public function monitorings()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
