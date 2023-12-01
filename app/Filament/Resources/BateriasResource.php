<?php

namespace App\Filament\Resources;


use App\Filament\Resources\BateriasResource\Pages;
use App\Filament\Resources\BateriasResource\RelationManagers;
use App\Models\Baterias;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\areadeper;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\ColorColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BateriasResource extends Resource
{
    protected static ?string $model = Baterias::class;

    protected static ?string $navigationIcon = 'heroicon-o-battery-0';
    protected static ?string $navigationGroup = 'Equipos';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('codigo_inventario')->required(),
                //TextInput::make('nombre')->required(),
                
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion'),
                //TextInput::make('ubicacion_i')->required(),
                TextInput::make('marca')->required(),
                TextInput::make('modelo')->required(),
                TextInput::make('tamaño')->required(),
                TextInput::make('numero_serie')->required(),
                TextInput::make('color')->required()->type('color'),
                Select::make('estado')
                        ->options([
                            'Bueno' => 'Bueno',
                            'Malo' => 'Malo',
                            'R/E' => 'R/E',
                        ])->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_inventario')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('numero_serie')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('Ubicacion.ubicacion')
                    ->badge()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('marca')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('modelo')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tamaño')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                ColorColumn::make('color')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estado')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true) ->badge(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),

                SelectFilter::make('marca')
                ->options(fn (): array => Baterias::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => Baterias::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => Baterias::query()->pluck('modelo', 'modelo')->all())
                
            ],layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\viewAction::make(),
            ],position: ActionsPosition::BeforeColumns)



            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\BulkActionGroup::make([
                    
                ]),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaterias::route('/'),
            'create' => Pages\CreateBaterias::route('/create'),
            'edit' => Pages\EditBaterias::route('/{record}/edit'),
        ];
    }    
   
}
