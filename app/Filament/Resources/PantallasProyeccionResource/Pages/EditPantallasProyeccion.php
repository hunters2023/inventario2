<?php

namespace App\Filament\Resources\PantallasProyeccionResource\Pages;

use App\Filament\Resources\PantallasProyeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPantallasProyeccion extends EditRecord
{
    protected static string $resource = PantallasProyeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
