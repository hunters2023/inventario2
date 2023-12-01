<?php



namespace App\Filament\Resources\BateriasResource\Pages;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

use App\Models\Baterias;
use App\Filament\Resources\BateriasResource;

class ListBaterias extends ListRecords
{
    protected static string $resource = BateriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->uniqueField('codigo_inventario')
                ->fields([
                    ImportField::make('codigo_inventario')->required(),
                    ImportField::make('ubicacion_id')->required(),
                    ImportField::make('marca')->required(),
                    ImportField::make('modelo')->required(),
                    ImportField::make('tamaño')->required(),
                    ImportField::make('numero_serie')->required(),
                    ImportField::make('color')->required(),
                    ImportField::make('estado')->required(),
                ])
                ->handleRecordCreation(function (array $data) {
                    // Buscar si ya existe una batería con el mismo código_inventario
                    $existingBateria = Baterias::where('codigo_inventario', $data['codigo_inventario'])->first();

                    if ($existingBateria) {
                        // Actualizar el registro existente si es necesario
                        $existingBateria->update($data);
                        return $existingBateria;
                    }

                    // Crear un nuevo registro si no existe
                    return Baterias::create($data);

                
                }),
        ];
    }
}
