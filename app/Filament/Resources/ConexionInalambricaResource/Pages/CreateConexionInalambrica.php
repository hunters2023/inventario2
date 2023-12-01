<?php

namespace App\Filament\Resources\ConexionInalambricaResource\Pages;

use App\Filament\Resources\ConexionInalambricaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConexionInalambrica extends CreateRecord
{
    protected static string $resource = ConexionInalambricaResource::class;
    
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
