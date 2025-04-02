<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = 'Member';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Member')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-m-bookmark-square')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('nama_company')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('alamat')
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_telepon')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('logo')
                            ->maxLength(255),

                    ])
                    ->columns(4),
                Section::make('Member')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-m-bookmark-square')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('nama_pemilik')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_ktp')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_npwp')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_rekening')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('atas_nama')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_telepon2')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('no_fax')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('member_expired')
                        ->required(),
                    ])
                    ->columns(2),
                Section::make('Member')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-m-bookmark-square')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('website')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('facebook')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('twitter')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('instagram')
                            ->maxLength(255),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Member List')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pemilik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_ktp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_npwp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_rekening')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('atas_nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telepon2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook')
                    ->searchable(),
                Tables\Columns\TextColumn::make('twitter')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instagram')
                    ->searchable(),
                Tables\Columns\TextColumn::make('member_expired')
                    ->date()
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
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMembers::route('/'),
        ];
    }
}
