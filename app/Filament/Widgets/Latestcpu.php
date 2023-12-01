<?php

namespace App\Filament\Widgets;

use App\Models\cpu; // Asegúrate de importar el modelo CPU adecuado
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class Latestcpu extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return cpu::query()
            ->where('estado', 'malo')
            ->latest()
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
         
            TextColumn::make('numero_serie'),
            TextColumn::make('estado'),
            TextColumn::make('modelo'),
            TextColumn::make('marca'),
            
            TextColumn::make('created_at')
                ->sortable()
                ->dateTime(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}