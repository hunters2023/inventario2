<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoIP extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion_id',
        'marca',
        'modelo',
        'numero_serie',
        'codigo_inventario',
        'mac_address',
        'estado'
    ];
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
}
