<?php

namespace App\Filament\Resources\RelojBiometricoResource\Pages;

use App\Filament\Resources\RelojBiometricoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelojBiometricos extends ListRecords
{
    protected static string $resource = RelojBiometricoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
