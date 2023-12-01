<?php

namespace App\Filament\Resources\CpuResource\Pages;

use App\Filament\Resources\CpuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCpu extends EditRecord
{
    protected static string $resource = CpuResource::class;

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
