<?php

namespace App\Filament\Resources\TelefonoIPResource\Pages;

use App\Filament\Resources\TelefonoIPResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTelefonoIP extends EditRecord
{
    protected static string $resource = TelefonoIPResource::class;

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
