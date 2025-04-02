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

use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Support\Facades\Auth;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Produk Informasi")
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-square-3-stack-3d')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('kode_barang')
                            // ->columnSpan([
                            //     'default' => 1,
                            //     'sm' => 1,
                            //     'md' => 2,
                            //     'lg' => 3,
                            //     'xl' => 4,
                            // ])
                            ->autofocus()
                            ->hint('Scan QR')
                            ->hintColor('primary')
                            ->helperText('Bisa scan QR Code')
                            ->required()
                            ->autocapitalize('words')
                            ->maxLength(50)
                            ->suffixIcon('heroicon-o-qr-code'),
                        Forms\Components\TextInput::make('nama_barang')
                            ->validationMessages([
                                'required' => 'The :attribute has already been registered.',
                            ])
                            ->columnSpan([
                                'default' => 1,
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 3,
                                'xl' => 4,
                            ])
                            ->autocapitalize('words')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('unit_id')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('kategori_id')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('merk_id')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Textarea::make('detail')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image(),
                        Forms\Components\RichEditor::make('product_detail')
                            ->columnSpanFull(),



                    ])
                    // ->inlineLabel()
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        'xl' => 5,
                    ]),
                Section::make('Produk Harga & Promo')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-banknotes')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('harga')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('stok_minimal')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('harga_beli')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('promosi'),
                        Forms\Components\TextInput::make('harga_promo')
                            ->numeric()
                            ->default(0),
                        Forms\Components\DatePicker::make('tanggal_mulai'),
                        Forms\Components\DatePicker::make('tanggal_berahir'),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 3,
                        'lg' => 4,
                        // 'xl' => 5,
                    ]),
                Section::make('Produk Information Stok')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-bars-arrow-down')
                    ->iconColor('primary')
                    ->schema([])
                    ->columns(4),
                Section::make('Produk Information Lainnya')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-gift-top')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('member_id')
                            ->default(Auth::user()->member_id)
                            // ->hidden()
                            ->readOnly()
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('dibuat_oleh')
                            ->default(Auth::user()->name)
                            // ->hidden()
                            ->readOnly()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('gudang_id')
                            ->readOnly()
                            ->default(Auth::user()->gudang_id),
                        Forms\Components\TextInput::make('cf1')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cf2')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cf3')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cf4')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cf5')
                            ->maxLength(100),
                    ])
                    ->columns(1),
                Section::make('Produk Information Supplier')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-o-bookmark-square')
                    ->iconColor('primary')
                    ->schema([
                        Forms\Components\TextInput::make('supplier1')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier1_part_no')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier1price')
                            ->numeric(),
                        Forms\Components\TextInput::make('supplier2')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier2_part_no')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier2_price')
                            ->numeric(),
                        Forms\Components\TextInput::make('supplier3')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier3_part_no')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier3_price')
                            ->numeric(),
                        Forms\Components\TextInput::make('supplier4')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier4_part_no')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier4_price')
                            ->numeric(),
                        Forms\Components\TextInput::make('supplier5')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier5_part_no')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('supplier5_price')
                            ->numeric(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Produk List')
            ->columns([

                Tables\Columns\TextColumn::make('kode_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('merk_id')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok_minimal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_beli')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('promosi')
                    ->boolean(),
                Tables\Columns\TextColumn::make('harga_promo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_berahir')
                    ->date()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('member_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('dibuat_oleh')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cf1')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cf2')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cf3')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cf4')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('cf5')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier1')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier1_part_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier1price')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('supplier2')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier2_part_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier2_price')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('supplier3')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier3_part_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier3_price')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('supplier4')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier4_part_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier4_price')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('supplier5')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier5_part_no')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('supplier5_price')
                //     ->numeric()
                //     ->sortable(),
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
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateHeading('No posts yet')
            ->emptyStateDescription('Once you write your first post, it will appear here.')
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'view' => Pages\ViewProduk::route('/{record}'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
