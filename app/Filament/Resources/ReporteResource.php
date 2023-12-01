<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteResource\Pages;
use App\Filament\Resources\ReporteResource\RelationManagers;
use App\Models\Reporte;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
class ReporteResource extends Resource
{
    protected static ?string $model = Reporte::class;
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'solicitud de equipo de mantenimiento';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                    Section::make('notificion')
                    ->description('solicitud de equipo de mantenimiento')
                    ->schema([
                        DatePicker::make('fecha')->required()->extraAttributes(['title' => 'Text input']),
                    TextInput::make('numero')->required() ->maxLength(255)->numeric()->inputMode('decimal'),
                     
                    Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->native(false),
      
                    TextInput::make('solicitante')->required() ->maxLength(255),
                    
                    TextInput::make('codigo')->required(),
                    ]) ->columns(3)  ,             
                   
                    
    
                    Section::make('Material')
                    ->description('En que entorno es el problema')
                    ->schema([
                     
                        Radio::make('infraestructura')
                        ->options([
                            'infraestructura' => 'Infraestructura',
                            'mobiliaria' => 'Mobiliaria',
                            'equipo_maquinarias' => 'Equipos_Maquinarias'
                            ])->descriptions([
                            'infraestructura' => 'Esto significa que el mantenimiento esta enfocado en las aread de conexiones inalambricas o cableado',
                            'mobiliaria' =>'Esto significa que el mantenimiento esta enfocado en las sillas y mesas',
                            'equipo_maquinarias' => 'Esto significa que el mantenimiento esta enfocado en todos los equipos electronicos del centro',
                       
                    ])->columns(3)          
                            ]),
                    
    
                    Section::make('detalles')
                    ->description('En que entorno es el problema')
                    ->schema([
                     
                        
                    TextInput::make('detallar_parte')->required(),
                    TextInput::make('cantidad')->required()->numeric()->inputMode('decimal'),
                    RichEditor::make('descripcion')->required()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])->disableToolbarButtons([
                        'attachFiles',
                        'strike',
                    ])->columnSpanfull(),


                    ])->columns(2),     
                                        
    
                    Section::make('Validacion')
                    ->description('En que entorno es el problema')
                    ->schema([
                        TextInput::make('firma_del_responsable')->helperText('Firma del encargado del area')->required()->columnSpanfull(),
                       
                        TextInput::make('autorizado_por')->helperText('Autorización de servicio generales')->required()->columnSpanfull(),
                        
                        
                        Toggle::make('leve')
                        ->label('Habilitar para Soporte Técnico')
                        ->onIcon('heroicon-m-bolt')
                        ->offIcon('heroicon-m-user')
                        ->onColor('success')
                        ->offColor('danger')
                        ->inline(false)
                    
                    ]) ->columns(2),                   
            
    
                    Section::make('Priorización del mantenimiento:')
                    ->description('uso esclusivo de servicios generales')
                    ->schema([
                        Radio::make('grave')
                        ->options([
                            'gravísimo' => 'gravísimo',
                            'Critico' => 'Critico',
                            'leve' => 'Leve'
                            ])->descriptions([
                            'gravísimo' => 'Esto significa que el mantenimiento que usted pide debe ser prioridad pero no inmediato ',
                            'Critico' =>'Esto significa que el mantenimiento que usted pide debe ser inmediato',
                            'leve' => 'Esto significa que el mantenimiento no es tan prioritario',
                           
                        ])->columnSpanfull()->columns(3)
                  
                    
                    ])




            ]);

        }  
                   
                       

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ToggleColumn::make('leve')
                ->label('Habilitar para Soporte Técnico')
                ->onIcon('heroicon-m-bolt')
                ->offIcon('heroicon-m-user')
                ->onColor('success')
                ->offColor('danger')
                ->inline(false),


                

                TextColumn::make('fecha')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('numero')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Ubicacion.ubicacion')
                ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('solicitante')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('infraestructura')->toggleable(isToggledHiddenByDefault: true)->label('Tipo de Problema')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'infraestructura' => 'info',
                    'mobiliaria' => 'warning',
                    'equipo_maquinarias' => 'danger',
                    '1' => 'blue', // Añade el manejo para '1' u otros casos según sea necesario
                    default => 'gray', // Manejo por defecto para cualquier otro caso no especificado
                }),
                //TextColumn::make('infraestructura')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                
                //TextColumn::make('equipos_maquinarias')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('detallar_parte')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('cantidad')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('firma_del_responsable')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('autorizado_por')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('grave')->toggleable(isToggledHiddenByDefault: true)->label('Prioridad del matenimiento')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'gravísimo' => 'danger',
                    'Critico' => 'warning',
                    'leve' => 'info',
                    '1' => 'blue', // Añade el manejo para '1' u otros casos según sea necesario
                    default => 'gray', // Manejo por defecto para cualquier otro caso no especificado
                }),
               
                //TextColumn::make('grave')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                //IconColumn::make('leve')->boolean()->toggleable(isToggledHiddenByDefault: true),
                //IconColumn::make('critica')->boolean()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'), //

                
                SelectFilter::make('infraestructura')
                ->options(fn (): array => reporte::query()->pluck('infraestructura', 'infraestructura')->all()),

                SelectFilter::make('grave')
                ->options(fn (): array => reporte::query()->pluck('grave', 'grave')->all()),
                //


                Filter::make('created_at')
            ->form([
        DatePicker::make('created_from')->label('desde'),
        DatePicker::make('created_until')->label('hasta'),
                      ])
             ->query(function (Builder $query, array $data): Builder {
                 return $query
                    ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );

          })->columnSpanfull()->columns(2)



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
            'index' => Pages\ListReportes::route('/'),
            'create' => Pages\CreateReporte::route('/create'),
            'edit' => Pages\EditReporte::route('/{record}/edit'),
        ];
    }    
}
