<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CpuResource\Pages;
use App\Filament\Resources\CpuResource\RelationManagers;
use App\Models\Cpu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
class CpuResource extends Resource
{
    protected static ?string $model = Cpu::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Equipos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                //TextInput::make('ubicacion')->required(),
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->required(),
                TextInput::make('marca')->required(),
                TextInput::make('modelo')->required(),
                TextInput::make('numero_serie')->required(),
                TextInput::make('codigo_inventario')->required(),
                TextInput::make('procesador')->required(),
                TextInput::make('disco_duro')->required(),
                TextInput::make('memoria_ram')->required(),

                Select::make('tarjeta_inalambrica')
                        ->options([
                            'si' => 'Si',
                            'no' => 'No',
                            
                        ])->native(false)->required(),
                        Select::make('tarjeta_video')
                        ->options([
                            'si' => 'Si',
                            'no' => 'No',  
                        ])->native(false)->required(),

              
                Select::make('sistema_operativo')
                ->options([
                    'WIN10x_64' => 'WIN10x_64',
                    'WIN10x_32' => 'WIN10x_32',
                    'WIN11x_64' => 'WIN11x_64',
                    
                ])->native(false)->required(),

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
                TextColumn::make('marca')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('modelo')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('procesador')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('disco_duro')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('memoria_ram')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tarjeta_inalambrica')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('tarjeta_video')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sistema_operativo')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('estado')->badge()->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'),//

                SelectFilter::make('marca')
                ->options(fn (): array => Cpu::query()->pluck('marca', 'marca')->all()),

                SelectFilter::make('estado')
                ->options(fn (): array => Cpu::query()->pluck('estado', 'estado')->all()),

                SelectFilter::make('modelo')
                ->options(fn (): array => Cpu::query()->pluck('modelo', 'modelo')->all())


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
            'index' => Pages\ListCpu::route('/'),
            'create' => Pages\CreateCpu::route('/create'),
            'edit' => Pages\EditCpu::route('/{record}/edit'),
        ];
    }    
}
