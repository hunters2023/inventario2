<?php

namespace App\Filament\Resources\SwitchesResource\Pages;

use App\Filament\Resources\SwitchesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSwitches extends CreateRecord
{
    protected static string $resource = SwitchesResource::class;

    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
