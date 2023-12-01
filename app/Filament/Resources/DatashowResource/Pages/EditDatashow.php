<?php

namespace App\Filament\Resources\DatashowResource\Pages;

use App\Filament\Resources\DatashowResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatashow extends EditRecord
{
    protected static string $resource = DatashowResource::class;

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
