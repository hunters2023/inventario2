<?php

namespace App\Filament\Resources\ReporteDelReporteResource\Pages;

use App\Filament\Resources\ReporteDelReporteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReporteDelReporte extends CreateRecord
{
    protected static string $resource = ReporteDelReporteResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
        
    }
}

