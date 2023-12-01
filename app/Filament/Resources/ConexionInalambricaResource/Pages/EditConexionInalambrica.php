<?php

namespace App\Filament\Resources\ConexionInalambricaResource\Pages;

use App\Filament\Resources\ConexionInalambricaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConexionInalambrica extends EditRecord
{
    protected static string $resource = ConexionInalambricaResource::class;

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
