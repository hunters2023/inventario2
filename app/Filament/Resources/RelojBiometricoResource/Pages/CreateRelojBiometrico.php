<?php

namespace App\Filament\Resources\RelojBiometricoResource\Pages;

use App\Filament\Resources\RelojBiometricoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRelojBiometrico extends CreateRecord
{
    protected static string $resource = RelojBiometricoResource::class;

    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
