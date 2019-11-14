<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'user_id', 'lugar_id', 'recorrido_id',
        'horallegada',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lugar()
    {
        return $this->belongsTo(Place::class);
    }
    public function recorrido()
    {
        return $this->belongsTo(Travel::class);
    }

}
