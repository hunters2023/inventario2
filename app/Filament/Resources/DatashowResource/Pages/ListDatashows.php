<?php

namespace App\Filament\Resources\DatashowResource\Pages;

use App\Filament\Resources\DatashowResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDatashows extends ListRecords
{
    protected static string $resource = DatashowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
