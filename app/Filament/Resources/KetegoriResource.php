<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KetegoriResource\Pages;
use App\Filament\Resources\KetegoriResource\RelationManagers;
use App\Models\Ketegori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;

class KetegoriResource extends Resource
{
    protected static ?string $model = Ketegori::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = 'Ketegori';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ketegori')
                ->description('The items you have selected for purchase')
                ->icon('heroicon-m-bookmark-square')
                ->iconColor('primary')
                ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(55),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('parent_id')
                    ->numeric(),
                ])
                ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Ketegori List')
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('parent_id')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListKetegoris::route('/'),
            'create' => Pages\CreateKetegori::route('/create'),
            'view' => Pages\ViewKetegori::route('/{record}'),
            'edit' => Pages\EditKetegori::route('/{record}/edit'),
        ];
    }
}
