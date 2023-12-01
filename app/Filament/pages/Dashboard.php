<?php
 
namespace App\Filament\Pages;
 
use Filament\Pages\Dashboard as BaseDashboard;
 
class Dashboard extends BaseDashboard
{
    // Customize properties or methods here

    protected static ?string $title = 'BIENVENIDOS';
    protected static ?string $navigationLabel = 'Inicio';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
}