<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SwitchesResource\Pages;
use App\Filament\Resources\SwitchesResource\RelationManagers;
use App\Models\Switches;
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
class SwitchesResource extends Resource
{
    protected static ?string $model = Switches::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationGroup = 'Equipos';

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
                TextInput::make('numero_puerto')->required()->numeric('decimal'),
                TextInput::make('fibra_canal')->required(),
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
                TextColumn::make('codigo_inventario')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('numero_serie')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                
                TextColumn::make('Ubicacion.ubicacion')
                    ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('marca')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('modelo')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('numero_puerto')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('fibra_canal')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('estado')->toggleable(isToggledHiddenByDefault: true)->badge()->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'), //

                SelectFilter::make('marca')
                ->options(fn (): array => switches::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => switches::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => switches::query()->pluck('modelo', 'modelo')->all())

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
            'index' => Pages\ListSwitches::route('/'),
            'create' => Pages\CreateSwitches::route('/create'),
            'edit' => Pages\EditSwitches::route('/{record}/edit'),
        ];
    }    
}
