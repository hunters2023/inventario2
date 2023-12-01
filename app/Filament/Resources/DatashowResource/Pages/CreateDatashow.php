<?php

namespace App\Filament\Resources\DatashowResource\Pages;

use App\Filament\Resources\DatashowResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDatashow extends CreateRecord
{
    protected static string $resource = DatashowResource::class;
    protected function getReddirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
