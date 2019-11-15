<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'user_id',
        'license_id',
        'placa',
        'marca',
        'chasis',
        'modelo',
        'foto',
        'asientos',
        'estado'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function license()
    {
        return $this->belongsTo(License::class);
    }
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
