<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auspice extends Model
{
    protected $fillable = [
        'estado',
        'nombre',
        'descripcion',
        'direccion',
        'telefono',
        'web',
        'contacto',
        'telefono_contacto',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
