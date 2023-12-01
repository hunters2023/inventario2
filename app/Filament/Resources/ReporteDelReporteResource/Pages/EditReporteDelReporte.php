<?php

namespace App\Filament\Resources\ReporteDelReporteResource\Pages;

use App\Filament\Resources\ReporteDelReporteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteDelReporte extends EditRecord
{
    protected static string $resource = ReporteDelReporteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
