<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\UserResource\Pages;
use App\Filament\Resources\Admin\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationLabel(): string
    {
        return 'Users';
    }

    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }

    public static function getModelLabel(): string
    {
        return __('Users');
    }

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                        FileUpload::make('image'),
                
                        TextInput::make('name')
                            ->required(),

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone')
                            ->required()
                            ->unique(ignoreRecord: true),

                        
                ])
              

                
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('picture')
                ->getStateUsing(function (User $record) {
                    return $record->picture;
                })
                ->circular(),
            TextColumn::make('name')
                ->translateLabel()
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->translateLabel()
                ->sortable()
                ->searchable()
                ->default('-'),

            TextColumn::make('phone')
                ->translateLabel()
                ->sortable()
                ->searchable()
                ->default('-'),

            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
