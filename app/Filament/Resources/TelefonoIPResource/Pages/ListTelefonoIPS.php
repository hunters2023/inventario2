<?php

namespace App\Filament\Resources\TelefonoIPResource\Pages;

use App\Filament\Resources\TelefonoIPResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTelefonoIPS extends ListRecords
{
    protected static string $resource = TelefonoIPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
