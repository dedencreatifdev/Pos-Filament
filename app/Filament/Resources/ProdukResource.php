<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Merk;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ramsey\Uuid\Type\Decimal;
use Ramsey\Uuid\Type\Integer;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produk';
    protected static ?string $navigationLabel = 'Produk List';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('warehouse_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('rack')
                    ->maxLength(55),
                TextInput::make('avg_cost')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Produk')
            ->columns([
                TextColumn::make('relProdukDetail.code')
                    ->label('Kode Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('relProdukDetail.name')

                    // ->canWrap('product_id')
                    ->wrap()
                    ->label('Name Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('relProdukDetail.relSatuan.name')
                    ->visibleFrom('sm')
                    ->label('Satuan')
                    ->searchable(),
                TextColumn::make('relProdukDetail.relCategori.name')
                    ->visibleFrom('sm')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('relProdukDetail.relBrand.name')
                    ->visibleFrom('sm')
                    ->label('Brand')
                    ->searchable(),
                TextColumn::make('relProdukDetail.price')
                    ->label('Harga')
                    ->numeric(decimalPlaces: 2)
                    ->alignCenter(),
                TextColumn::make('quantity')
                    ->label('Stok')
                    ->numeric(decimalPlaces: 2)
                    ->color([
                        // 'danger' => fn($state, $record) => (int)$state < $record->relProdukDetail->alert_quantity,
                        // 'success' => fn($state, $record) => (int)$state >= 0,
                        // 'danger'=>default,
                    ])
                    // ->color([
                    //     'success' => '0',
                    //     'danger' => '1',
                    // ])
                    ->badge()
                    ->color(fn(string $state, $record): string => match (true) {
                        (int)$state <= $record->relProdukDetail->alert_quantity => 'danger',
                        (int)$state > $record->relProdukDetail->alert_quantity => 'success',
                        default => 'warning',
                    })
                    ->tooltip(fn(string $state, $record): string => match (true) {
                        (int)$state > $record->relProdukDetail->alert_quantity => 'Stok lebih dari ' . (int)$record->relProdukDetail->alert_quantity,
                        (int)$state == $record->relProdukDetail->alert_quantity => 'Stok sama dengan ' . (int)$record->relProdukDetail->alert_quantity,
                        (int)$state < $record->relProdukDetail->alert_quantity => 'Stok kurang dari ' . (int)$record->relProdukDetail->alert_quantity,
                        default => 'Status stok tidak diketahui',
                    })
                    ->weight(FontWeight::Bold)
                    ->alignCenter(),
                TextColumn::make('avg_cost')
                    ->label('Hpp')
                    ->visibleFrom('sm')
                    ->numeric(decimalPlaces: 2)
                    ->alignCenter(),
                TextColumn::make('relProdukDetail.alert_quantity')
                    ->label('Min Stok')
                    ->visibleFrom('sm')
                    ->numeric(decimalPlaces: 2)
                    ->alignCenter(),
                TextColumn::make('relGudang.name')
                    ->visibleFrom('lg')
                    ->label('Gudang')
                    ->sortable(),
                TextColumn::make('rack')
                    ->visibleFrom('lg'),
            ])
            ->recordClasses(fn(Model $record) => match ($record->relProdukDetail->quantity) {
                'draft' => 'opacity-30',
                '0.0000' => 'border-s-2 border-orange-600 dark:border-orange-300',
                'published' => 'border-s-2 border-green-600 dark:border-green-300',
                default => 'bg-primary-500',
            })
            ->paginated([15, 25, 35, 50, 100, 'all'])
            ->striped()
            ->filters([
                SelectFilter::make('brand')
                    ->label('Merk')
                    ->relationship('relProdukDetail.relBrand', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->relationship('relProdukDetail.relCategori', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('warehouse_id')
                    ->label('Giudang')
                    ->relationship('relGudang', 'name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-document-text')
                        ->slideOver()
                        ->label('Edit')
                        ->color('success'),
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-document-text')
                        ->slideOver()
                        ->label('Detail Produk')
                        ->color('info'),
                ])
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('relProdukDetail.code')
                    ->prefix(': ')
                    ->weight(FontWeight::Bold)
                    ->label('Kode Produk'),
                TextEntry::make('relProdukDetail.name')
                    ->prefix(': ')
                    ->label('Nama Produk'),
                TextEntry::make('relProdukDetail.relSatuan.name')
                    ->prefix(': ')
                    // ->badge()
                    ->label('Satuan'),
                TextEntry::make('relProdukDetail.relCategori.name')
                    ->prefix(': ')
                    // ->badge()
                    ->label('Kategori'),
                TextEntry::make('relProdukDetail.relBrand.name')
                    ->prefix(': ')
                    // ->badge()
                    ->label('Brand'),
            ])
            ->inlineLabel()
            ->columns(1);
    }
}
