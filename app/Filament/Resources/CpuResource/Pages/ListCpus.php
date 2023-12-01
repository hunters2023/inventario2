<?php

namespace App\Filament\Resources\CpuResource\Pages;

use App\Filament\Resources\CpuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCpu extends ListRecords
{
    protected static string $resource = CpuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
