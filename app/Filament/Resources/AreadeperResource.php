<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AreadeperResource\Pages;
use App\Filament\Resources\AreadeperResource\RelationManagers;
use App\Models\Areadeper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use app\models\Baterias;
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
use App\Filament\Resources\Ubicacion;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;

class AreadeperResource extends Resource
{
    protected static ?string $model = Areadeper::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Areas';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->required(),
                //textInput::make('ubicacion'),
                
                TextInput::make('capacidad_maxima')->required(),
                TextInput::make('encargado_de_area')->required(),
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Ubicacion.ubicacion')
                ->badge()->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('capacidad_maxima')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('encargado_de_area')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),
              
                SelectFilter::make('nombre')
                ->options(fn (): array => areadeper::query()->pluck('nombre', 'nombre')->all())
//
            ],layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
            'index' => Pages\ListAreadepers::route('/'),
            'create' => Pages\CreateAreadeper::route('/create'),
            'edit' => Pages\EditAreadeper::route('/{record}/edit'),
        ];
    }    
}
