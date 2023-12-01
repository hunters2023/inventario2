<?php

namespace App\Filament\Widgets;

use Spatie\Permission\PermissionRegistrar as shield;
use App\Models\User;
use App\Models\Baterias;
use App\Models\ConexionInalambrica;
use App\Models\cpu;
use App\Models\Datashow;
use App\Models\Impresora;
use App\Models\Laptop;
use App\Models\Monitores;
use App\Models\PantallasProyeccion;
use App\Models\RelojBiometrico;
use App\Models\Switches;
use App\Models\TelefonoIP;
use App\Models\TextMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

           
            Stat::make('Total Baterias', Baterias::count()),
            Stat::make('Total Conexiones inalambricas', ConexionInalambrica::count()),
            Stat::make('Total cpus', cpu::count()),
            Stat::make('Total Monitores', Monitores::count()),
            Stat::make('Total Laptops', Laptop::count()),
            Stat::make('Total Datashows', Datashow::count()),
            Stat::make('Total Impresoras', Impresora::count()),
            Stat::make('Total PantallasProyeccion', PantallasProyeccion::count()),
            Stat::make('Total relojbiometrico', RelojBiometrico::count()),
            Stat::make('Total Switches', Switches::count()),
            Stat::make('Total TelefonosIp', TelefonoIP::count()),
            Stat::make('Total de mensajes', TextMessage::count()),
           

    
          
        ];


        

          


        
    }
}
