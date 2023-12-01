<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Switches extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion_id',
        'marca',
        'modelo',
        'tamaño',
        'numero_serie',
        'codigo_inventario',
        'numero_puerto',
        'fibra_canal',
        'estado'
    ];
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
}
