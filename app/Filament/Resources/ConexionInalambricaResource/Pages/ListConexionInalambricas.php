<?php

namespace App\Filament\Resources\ConexionInalambricaResource\Pages;

use App\Filament\Resources\ConexionInalambricaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConexionInalambricas extends ListRecords
{
    protected static string $resource = ConexionInalambricaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
