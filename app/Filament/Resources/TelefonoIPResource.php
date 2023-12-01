<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TelefonoIPResource\Pages;
use App\Filament\Resources\TelefonoIPResource\RelationManagers;
use App\Models\TelefonoIP;
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
class TelefonoIPResource extends Resource
{
    protected static ?string $model = TelefonoIP::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Equipos';
    protected static ?string $navigationLabel = 'Telefonos IP';

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
                TextInput::make('mac_address')->required(),
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
                    ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true)->sortable(),
                TextColumn::make('marca')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('modelo')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('mac_address')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                TextColumn::make('estado')->toggleable(isToggledHiddenByDefault: true)->badge()->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),  //


                SelectFilter::make('marca')
                ->options(fn (): array => telefonoip::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => telefonoip::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => telefonoip::query()->pluck('modelo', 'modelo')->all())


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
            'index' => Pages\ListTelefonoIPS::route('/'),
            'create' => Pages\CreateTelefonoIP::route('/create'),
            'edit' => Pages\EditTelefonoIP::route('/{record}/edit'),
        ];
    }    
}
