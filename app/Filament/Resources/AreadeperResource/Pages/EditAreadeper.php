<?php

namespace App\Filament\Resources\AreadeperResource\Pages;

use App\Filament\Resources\AreadeperResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAreadeper extends EditRecord
{
    protected static string $resource = AreadeperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
