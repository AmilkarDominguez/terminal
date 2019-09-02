<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'estado',
        'nombre',
        'descripcion',
        'logo',
        'link',
        'user_id',
        'auspice_id',
        'presenter_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function auspice()
    {
        return $this->belongsTo(Auspice::class);
    }
    public function presenter()
    {
        return $this->belongsTo(Presenter::class);
    }
}
