<?php

namespace App\Filament\Resources;

use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use App\Services\TextMessageService;
use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Access Control';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->required()->email(),
                TextInput::make('password')->required()->password()->hiddenOn('edit'),
                Select::make('roles_id')
                ->relationship('roles', 'name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email') ->icon('heroicon-m-envelope')->sortable()->searchable() ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('roles.name')
                ->sortable()->badge()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            
            ],layout: FiltersLayout::AboveContent)

            ->actions([
                Tables\Actions\viewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                BulkAction::make('send_message')
                ->form([
                    Textarea::make('message')
                        ->placeholder('Enter your Message')
                        ->rows(5)
                        ->required(),
                    Textarea::make('remarks')
                        ->placeholder('Enter remarks if any.')
                        ->rows(2),
                ])
                ->action(function (array $data, Collection $records) {
                    TextMessageService::sendMessage($records, $data);

                    foreach ($records as $user){
                        Notification::make()
                        ->title(' A new text message has been sent to you')
                        ->sendToDatabase($user);
                    }

                    Notification::make()
                        ->title('Messages Sent Successfully')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->modalButton('Send Message')
                ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
