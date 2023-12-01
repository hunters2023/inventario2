<?php

namespace App\Filament\Resources\CpuResource\Pages;

use App\Filament\Resources\CpuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCpu extends CreateRecord
{
    protected static string $resource = CpuResource::class;
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
