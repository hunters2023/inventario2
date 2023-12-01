<?php

namespace App\Filament\Resources\ReporteDelReporteResource\Pages;

use App\Filament\Resources\ReporteDelReporteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReporteDelReportes extends ListRecords
{
    protected static string $resource = ReporteDelReporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
