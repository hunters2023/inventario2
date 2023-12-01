<?php

namespace App\Filament\Resources\MonitoresResource\Pages;

use App\Filament\Resources\MonitoresResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMonitores extends CreateRecord
{
    protected static string $resource = MonitoresResource::class;

    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
