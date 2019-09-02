<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
    protected $fillable = [
        'estado',
        'nombre',
        'descripcion',
        'logo',
        'direccion',
        'telefono',
        'email',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
