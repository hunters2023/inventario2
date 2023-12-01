<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baterias extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion_id', // Cambia 'ubicacion' a 'ubicacion_id'
        'marca',
        'modelo',
        'tamaño',
        'numero_serie',
        'codigo_inventario',
        'color',
        'estado'
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
    public function Areadeper()
    {
        return $this->belongsTo(Areadeper::class, 'nombre');
    }


   
}
