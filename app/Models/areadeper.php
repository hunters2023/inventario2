<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areadeper extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ubicacion_id',
        'capacidad_maxima',
        'encargado_de_area',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
 
    public function Monitor() {
        return $this->hasMany(Monitor::class, 'nombre');
    }
    public function Baterias() {
        return $this->hasMany(Bateria::class, 'nombre');
    }
  
  
}
