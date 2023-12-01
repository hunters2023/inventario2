<?php

namespace App\Filament\Resources\AreadeperResource\Pages;

use App\Filament\Resources\AreadeperResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAreadepers extends ListRecords
{
    protected static string $resource = AreadeperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
