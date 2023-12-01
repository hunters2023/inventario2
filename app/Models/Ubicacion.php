<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicaciones'; 

    protected $fillable = ['ubicacion'];

    /*public function baterias()
    {
        return $this->hasMany(Baterias::class, 'ubicacion_id');
    }*/

    
    public function areadepers()
    {
        return $this->hasMany(Areadeper::class, 'ubicacion_id');
    }
    public function Baterias()
    {
        return $this->hasMany(Areadeper::class, 'ubicacion_id');
    }
    public function ConexionInalambricas()
    {
        return $this->hasMany(ConexionInalambrica::class, 'ubicacion_id');
    }
    public function Cpus()
    {
        return $this->hasMany(Cpu::class, 'ubicacion_id');
    }
    public function DataShows()
    {
        return $this->hasMany(DataShow::class, 'ubicacion_id');
    }
    public function Impresoras()
    {
        return $this->hasMany(Impresora::class, 'ubicacion_id');
    }
    public function Laptops()
    {
        return $this->hasMany(Laptop::class, 'ubicacion_id');
    }
    public function Monitores()
    {
        return $this->hasMany(Monitor::class, 'ubicacion_id');
    }
    public function PantallasProyecciones()
    {
        return $this->hasMany(PantallasProyeccion::class, 'ubicacion_id');
    }
    public function RelojBiometricos()
    {
        return $this->hasMany(RelojBiometrico::class, 'ubicacion_id');
    }
    public function reporte()
    {
        return $this->hasMany(reporte::class, 'ubicacion_id');
    }
    public function reportedelreporte()
    {
        return $this->hasMany(ReporteDelReporte::class, 'ubicacion_id');
    }

}
