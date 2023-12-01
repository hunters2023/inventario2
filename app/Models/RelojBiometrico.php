<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelojBiometrico extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion_id',
        'marca',
        'modelo',
        'numero_serie',
        'codigo_inventario',
        'estado'
    ];
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
}
