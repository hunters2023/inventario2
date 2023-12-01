<?php

namespace App\Filament\Resources\PantallasProyeccionResource\Pages;

use App\Filament\Resources\PantallasProyeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPantallasProyeccions extends ListRecords
{
    protected static string $resource = PantallasProyeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
