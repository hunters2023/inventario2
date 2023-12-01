<?php

namespace App\Filament\Resources;
use Filament\Tables\Columns\ColorColumn;
use App\Filament\Resources\MonitoresResource\Pages;
use App\Filament\Resources\MonitoresResource\RelationManagers;
use App\Models\Monitores;
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
class MonitoresResource extends Resource
{
    protected static ?string $model = Monitores::class;

    protected static ?string $navigationIcon = 'heroicon-o-tv';
    protected static ?string $navigationGroup = 'Equipos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->required(),
                //TextInput::make('ubicacion')->required(),
                TextInput::make('marca')->required(),
                TextInput::make('modelo')->required(),
                TextInput::make('tamaño')->required(),
                TextInput::make('numero_serie')->required(),
                TextInput::make('codigo_inventario')->required(),
                TextInput::make('color')->required()->type('color'),
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
                TextColumn::make('tamaño')->toggleable(isToggledHiddenByDefault: true)->sortable()->searchable(),
                ColorColumn::make('color')->toggleable(isToggledHiddenByDefault: true)->sortable(),
                TextColumn::make('estado')->toggleable(isToggledHiddenByDefault: true)->badge()->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),  //

                SelectFilter::make('marca')
                ->options(fn (): array => Monitores::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => Monitores::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => Monitores::query()->pluck('modelo', 'modelo')->all())

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
            'index' => Pages\ListMonitores::route('/'),
            'create' => Pages\CreateMonitores::route('/create'),
            'edit' => Pages\EditMonitores::route('/{record}/edit'),
        ];
    }    
}
