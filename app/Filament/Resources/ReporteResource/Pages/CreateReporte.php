<?php

namespace App\Filament\Resources\ReporteResource\Pages;

use App\Filament\Resources\ReporteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReporte extends CreateRecord
{
    protected static string $resource = ReporteResource::class;
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
