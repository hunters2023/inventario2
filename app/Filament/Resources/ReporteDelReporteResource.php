<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteDelReporteResource\Pages;
use App\Filament\Resources\ReporteDelReporteResource\RelationManagers;
use App\Models\ReporteDelReporte;
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
use Filament\Forms\Components\Radio;

class ReporteDelReporteResource extends Resource
{
    protected static ?string $model = ReporteDelReporte::class;
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Recepcion del trabajo de servicio';
    protected static ?int $navigationSort = 2;
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                Section::make('Datos')
                ->description('Recepcion del trabajo de servicio')
                ->schema([
                    DatePicker::make('fecha')->required()->extraAttributes(['title' => 'Text input'])->required(),
                TextInput::make('solicitud_numero')->required() ->maxLength(255),
                TextInput::make('orden_servicio')->required(),

                
                Select::make('ubicacion_id')->relationship('Ubicacion', 'ubicacion')->native(false)->required(),
                
             
                ]) ->columns(2), 
                
                Section::make('info')
                ->description('informacion del trabajo realizado')
                ->schema([
                    TextInput::make('codigo')->required(),
                    DatePicker::make('fecha_conclusion')->required(),

                    RichEditor::make('descripcion_trabajo_realizado')->required()
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
                ]) ->columns(2), 


                Section::make('Encargados')
                ->description('personal encargado de la supervision')
                ->schema([
                    
                    TextInput::make('realizado_por')->required(),
                    TextInput::make('supervisado_por')->required(),


                    ]) ->columns(2),
                    
                Section::make('Resultado')
                ->description('Resultados finales')
                ->schema([

                    Radio::make('solucionado')
                        ->options([
                            'Solucionado' => 'Solucionado',
                            'No_Solucionado' => 'No_Solucionado',
                            
                            ])->descriptions([
                            'Solucionado' => 'Esto significa que el mantenimiento que usted pidio fue resuelto  ',
                            'No_Solucionado' =>'Esto significa que el mantenimiento que usted pide no fue resuelto',

                            ])->columns()->columnSpanfull()->required(),
                            
                            RichEditor::make('Porque_no_solucionado')
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



                ]) ,


                Section::make('Notifico ')
                ->description('Quien resibio el informe')
                ->schema([
                TextInput::make('recibido_por')->required()
                ]) ->columns(1),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('fecha')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('solicitud_numero')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orden_servicio')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),


                TextColumn::make('Ubicacion.ubicacion')
                                                        ->badge()->searchable()->toggleable(isToggledHiddenByDefault: true),


                TextColumn::make('codigo')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('fecha_conclusion')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('realizado_por')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('supervisado_por')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),



                TextColumn::make('solucionado')->toggleable(isToggledHiddenByDefault: true)->label('Prioridad del matenimiento')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Solucionado' => 'info',
                    'No_Solucionado' => 'warning',
                    
                    '1' => 'blue', // Añade el manejo para '1' u otros casos según sea necesario
                    default => 'gray', // Manejo por defecto para cualquier otro caso no especificado
                }),





                //TextColumn::make('porque_no_solucionado')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('recibido_por')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
               
                SelectFilter::make('Ubicacion')
                ->relationship('Ubicacion', 'ubicacion'), //

                
                //SelectFilter::make('')
                //->options(fn (): array => ReporteDelReporte::query()->pluck('infraestructura', 'infraestructura')->all()),

                SelectFilter::make('solucionado')
                ->options(fn (): array => ReporteDelReporte::query()->pluck('solucionado', 'solucionado')->all()),
               
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
            'index' => Pages\ListReporteDelReportes::route('/'),
            'create' => Pages\CreateReporteDelReporte::route('/create'),
            'edit' => Pages\EditReporteDelReporte::route('/{record}/edit'),
        ];
    }    
}
