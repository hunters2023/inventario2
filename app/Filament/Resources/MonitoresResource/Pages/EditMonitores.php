<?php

namespace App\Filament\Resources\MonitoresResource\Pages;

use App\Filament\Resources\MonitoresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonitores extends EditRecord
{
    protected static string $resource = MonitoresResource::class;

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
