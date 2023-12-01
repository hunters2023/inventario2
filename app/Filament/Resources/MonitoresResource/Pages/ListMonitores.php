<?php

namespace App\Filament\Resources\MonitoresResource\Pages;

use App\Filament\Resources\MonitoresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonitores extends ListRecords
{
    protected static string $resource = MonitoresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
