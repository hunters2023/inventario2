<?php

namespace App\Filament\Resources\TelefonoIPResource\Pages;

use App\Filament\Resources\TelefonoIPResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTelefonoIP extends CreateRecord
{
    protected static string $resource = TelefonoIPResource::class;
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
