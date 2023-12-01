<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpresoraResource\Pages;
use App\Filament\Resources\ImpresoraResource\RelationManagers;
use App\Models\Impresora;
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
class ImpresoraResource extends Resource
{
    protected static ?string $model = Impresora::class;

    protected static ?string $navigationIcon = 'heroicon-o-printer';
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
                TextColumn::make('numero_serie')->searchable()->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('Ubicacion.ubicacion')
                    ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('marca')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('modelo')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estado')->toggleable(isToggledHiddenByDefault: true)->badge()->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'), //

                SelectFilter::make('marca')
                ->options(fn (): array => impresora::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => impresora::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => impresora::query()->pluck('modelo', 'modelo')->all())

            ],layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\viewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListImpresoras::route('/'),
            'create' => Pages\CreateImpresora::route('/create'),
            'edit' => Pages\EditImpresora::route('/{record}/edit'),
        ];
    }    
}
