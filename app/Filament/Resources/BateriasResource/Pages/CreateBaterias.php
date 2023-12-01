<?php

namespace App\Filament\Resources\BateriasResource\Pages;

use App\Filament\Resources\BateriasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBaterias extends CreateRecord
{
    protected static string $resource = BateriasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
