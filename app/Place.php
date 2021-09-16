<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        
        'user_id',
        'nombre',
        // 'departamento',
        'descripcion',
        'estado',
        'department_id'
        

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function travelO()
    {
        return $this->belongsTo(Travel::class);
    }
    public function travelD()
    {
        return $this->belongsTo(Travel::class);
    }
    public function Monitoring()
    {
        return $this->belongsTo(Monitoring::class);
    }

}
