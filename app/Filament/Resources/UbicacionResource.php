<?php

namespace App\Filament\Resources;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\UbicacionResource\Pages;
use App\Filament\Resources\UbicacionResource\RelationManagers;
use App\Models\Ubicacion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Baterias;
use App\Models\areadeper;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;

class UbicacionResource extends Resource
{
    protected static ?string $model = Ubicacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Ubicaciones';
    protected static ?string $navigationGroup = 'Areas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ubicacion')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ubicacion')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
               //
            ],layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\viewAction::make(),
            ],position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUbicacions::route('/'),
            'create' => Pages\CreateUbicacion::route('/create'),
            'edit' => Pages\EditUbicacion::route('/{record}/edit'),
        ];
    }    
}
