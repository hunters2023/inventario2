<?php

namespace App\Filament\Resources\BateriasResource\Pages;

use App\Filament\Resources\BateriasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaterias extends EditRecord
{
    protected static string $resource = BateriasResource::class;

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
