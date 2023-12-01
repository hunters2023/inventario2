<?php

namespace App\Filament\Resources\SwitchesResource\Pages;

use App\Filament\Resources\SwitchesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSwitches extends EditRecord
{
    protected static string $resource = SwitchesResource::class;

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
