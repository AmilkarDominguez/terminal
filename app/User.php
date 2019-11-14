<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','state',
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
}
