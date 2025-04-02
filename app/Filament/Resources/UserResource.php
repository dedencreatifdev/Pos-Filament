<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = 'User';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Informasi')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-user')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            // ->inlineLabel()
                            ->maxLength(100),
                        Forms\Components\Textarea::make('alamat')
                        // ->inlineLabel()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('jenis_kelamin')
                            ->inlineLabel()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('no_telepon')
                            ->inlineLabel()
                            ->tel()
                            ->maxLength(50),
                        Forms\Components\FileUpload::make('image')
                            ->inlineLabel()
                            ->image(),


                    ])
                    ->columns(4),
                Section::make('User, email & password')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->inlineLabel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->inlineLabel()
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->inlineLabel()
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(4),
                Section::make('Biller & Setting')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-banknotes')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('member_id')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('gudang_id')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('biller_id')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('show_cost')
                            ->numeric(),
                        Forms\Components\TextInput::make('show_price')
                            ->numeric(),
                        Forms\Components\TextInput::make('award_points')
                            ->numeric(),
                    ])
                    ->inlineLabel()
                    ->columns(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('User List')
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('member_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gudang_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('biller_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('show_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('show_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('award_points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated([15, 25, 35, 50, 100, 'all'])
            ->striped()
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
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
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
