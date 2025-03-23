<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Ketegori;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Produk Informasi')
                        ->columns(4)
                        ->schema([
                            TextInput::make('type')
                                ->inlineLabel()
                                ->required()
                                ->maxLength(55)
                                ->default('standard'),
                            TextInput::make('barcode_symbology')
                                ->label('Barcode')
                                ->inlineLabel()
                                ->required()
                                ->maxLength(55)
                                ->default('code128'),
                            TextInput::make('code')
                                ->inlineLabel()
                                ->required()
                                ->maxLength(50),

                            TextInput::make('unit')
                                ->inlineLabel()
                                ->numeric()
                                ->default(null),


                            TextInput::make('category_id')
                                ->inlineLabel()
                                ->required()
                                ->numeric(),
                            TextInput::make('brand')
                                ->inlineLabel()
                                ->numeric()
                                ->default(null),
                            TextInput::make('name')
                                ->columnSpanFull()
                                ->required()
                                ->maxLength(255),
                            RichEditor::make('details')
                                ->columnSpanFull(),

                        ]),
                    Wizard\Step::make('Deskripsi dan Image')
                        ->schema([

                            RichEditor::make('product_details')
                                ->columnSpanFull(),

                            FileUpload::make('image')
                                ->image(),
                            TextInput::make('file')
                                ->maxLength(100)
                                ->default(null),

                        ]),

                    Wizard\Step::make('Harga dan Promo')
                        // ->icon('heroicon-m-shopping-bag')
                        ->columns(3)
                        ->schema([
                            TextInput::make('price')
                                ->columnSpanFull()
                                ->required()
                                ->numeric()
                                ->prefix('Rp'),
                            TextInput::make('alert_quantity')
                                ->columnSpanFull()
                                ->numeric()
                                ->default(20.0000),
                            Toggle::make('promotion')
                                ->columnSpanFull(),
                            TextInput::make('promo_price')
                                ->numeric()
                                ->default(null),
                            DatePicker::make('start_date'),
                            DatePicker::make('end_date'),
                            Toggle::make('tax_rate'),
                            Toggle::make('track_quantity'),
                            Toggle::make('tax_method'),

                        ]),

                    Wizard\Step::make('Supplier Price')
                        ->columns(3)
                        ->schema([
                            TextInput::make('supplier1')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier1price')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier1_part_no')
                                ->maxLength(50)
                                ->default(null),

                            TextInput::make('supplier2')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier2price')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier2_part_no')
                                ->maxLength(50)
                                ->default(null),

                            TextInput::make('supplier3')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier3price')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier3_part_no')
                                ->maxLength(50)
                                ->default(null),

                            TextInput::make('supplier4')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier4price')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier4_part_no')
                                ->maxLength(50)
                                ->default(null),

                            TextInput::make('supplier5')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier5price')
                                ->numeric()
                                ->default(null),
                            TextInput::make('supplier5_part_no')
                                ->maxLength(50)
                                ->default(null),
                        ]),

                    Wizard\Step::make('Informasi Lainnya')
                        ->columns(3)
                        ->schema([
                            TextInput::make('cf1')
                                ->maxLength(255)
                                ->default(null),
                            TextInput::make('cf2')
                                ->maxLength(255)
                                ->default(null),
                            TextInput::make('cf3')
                                ->maxLength(255)
                                ->default(null),
                            TextInput::make('cf4')
                                ->maxLength(255)
                                ->default(null),
                            TextInput::make('cf5')
                                ->maxLength(255)
                                ->default(null),
                            TextInput::make('cf6')
                                ->maxLength(255)
                                ->default(null),
                        ]),

                    Wizard\Step::make('Relation')

                        ->columns(3)
                        ->schema([
                            Section::make()
                                ->relationship('relProdukDetail')
                                ->schema([
                                    TextInput::make('rack')
                                ])
                        ])
                ]),


            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('relSatuan.name')
                    ->label('Satuan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('relCategori.name')
                    ->label('Kategori')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('relBrand.name')
                    ->label('Merk')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alert_quantity')
                    ->label('Alert')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                Tables\Columns\TextColumn::make('promo_price')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated([15, 20, 25, 50, 100, 'all'])
            ->filters([
                SelectFilter::make('category_id')
                    ->options(Ketegori::all()->pluck('name', 'id'))
                    ->searchable()
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'view' => Pages\ViewProduk::route('/{record}'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
