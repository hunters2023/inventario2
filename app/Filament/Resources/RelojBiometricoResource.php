<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelojBiometricoResource\Pages;
use App\Filament\Resources\RelojBiometricoResource\RelationManagers;
use App\Models\RelojBiometrico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
class RelojBiometricoResource extends Resource
{
    protected static ?string $model = RelojBiometrico::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Equipos';
    protected static ?string $navigationLabel = 'Relojes Biometricos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->required(),
                //TextInput::make('ubicacion')->required(),
                TextInput::make('marca')->required(),
                TextInput::make('modelo')->required(),
                TextInput::make('numero_serie')->required(),
                TextInput::make('codigo_inventario')->required(),
                Select::make('estado')
                        ->options([
                            'Bueno' => 'Bueno',
                            'Malo' => 'Malo',
                            'R/E' => 'R/E',
                        ])->native(false)->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_inventario')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('numero_serie')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                
                TextColumn::make('Ubicacion.ubicacion')
                    ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true)->sortable(),
                TextColumn::make('marca')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('modelo')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('estado')->toggleable(isToggledHiddenByDefault: true)->badge()->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),   //

                SelectFilter::make('marca')
                ->options(fn (): array => Relojbiometrico::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => Relojbiometrico::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => Relojbiometrico::query()->pluck('modelo', 'modelo')->all())

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
            'index' => Pages\ListRelojBiometricos::route('/'),
            'create' => Pages\CreateRelojBiometrico::route('/create'),
            'edit' => Pages\EditRelojBiometrico::route('/{record}/edit'),
        ];
    }    
}
