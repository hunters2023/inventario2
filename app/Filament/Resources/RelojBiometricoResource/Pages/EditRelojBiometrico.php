<?php

namespace App\Filament\Resources\RelojBiometricoResource\Pages;

use App\Filament\Resources\RelojBiometricoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelojBiometrico extends EditRecord
{
    protected static string $resource = RelojBiometricoResource::class;

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
