<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteDelReporte extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha', 'solicitud_numero', 'orden_servicio', 'ubicacion_id',
        'descripcion_trabajo_realizado', 'realizado_por', 'supervisado_por',
        'solucionado', 'no_solucionado', 'porque_no_solucionado', 'recibido_por','fecha_conclusion','codigo'];


        public function ubicacion()
        {
            return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
        }
}
