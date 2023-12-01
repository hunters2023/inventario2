<?php

namespace App\Filament\Resources\PantallasProyeccionResource\Pages;

use App\Filament\Resources\PantallasProyeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePantallasProyeccion extends CreateRecord
{
    protected static string $resource = PantallasProyeccionResource::class;

    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
