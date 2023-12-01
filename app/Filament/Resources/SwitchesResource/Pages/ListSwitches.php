<?php

namespace App\Filament\Resources\SwitchesResource\Pages;

use App\Filament\Resources\SwitchesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSwitches extends ListRecords
{
    protected static string $resource = SwitchesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
