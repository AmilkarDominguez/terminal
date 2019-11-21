<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $fillable = [
        'user_id', 'origen_id', 'destino_id','bus_id',
        'detalle', 'salida','llegada', 'latitud', 'longitud','code'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function origen()
    {
        return $this->belongsTo(Place::class);
    }
    public function destino()
    {
        return $this->belongsTo(Place::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function Monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }
}
