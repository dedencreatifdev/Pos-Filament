<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Actions\ActionGroup;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tipe_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kode_produk')
                    ->required()
                    ->maxLength(25),
                Forms\Components\TextInput::make('nama_barang')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('satuan_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kategori_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('merk_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('harga_jual')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('stok_alert')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('gudang_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('lokasi_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('rak_id')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('barcode')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('barcode_type')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('keterangan')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('foto')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Produk')
            ->description('Manage your Produk here.')
            ->columns([
                
                Tables\Columns\TextColumn::make('tipe_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('merk_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_jual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok_alert')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gudang_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rak_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('barcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('barcode_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
            ->paginated([15, 30, 50, 100, 'all'])
            ->defaultPaginationPageOption(15)
            ->striped()
            ->emptyStateHeading('Data Produk Kosong')
            ->emptyStateDescription('Once you write your first Produk, it will appear here.')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageProduks::route('/'),
        ];
    }
}
