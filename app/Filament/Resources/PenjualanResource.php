<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\Penjualan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Penjualan';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Split::make([
                    Section::make('')
                        ->description('Prevent abuse by limiting the number of requests per period')
                        ->schema([
                            TextInput::make('customer_id')
                                ->inlineLabel()
                                // ->hidden()
                                ->required()
                                ->numeric(),
                            TextInput::make('customer')
                                ->inlineLabel()
                                ->required()
                                ->maxLength(55),
                            TextInput::make('biller_id')
                                ->inlineLabel()
                                ->required()
                                ->numeric(),
                            TextInput::make('biller')
                                ->inlineLabel()
                                ->required()
                                ->maxLength(55),
                            TextInput::make('note')
                                ->columnSpanFull()
                                ->maxLength(1000),
                        ])

                        ->columns([
                            'default' => 1,
                            'sm' => 2,
                            'md' => 3,
                            // 'lg' => 4,
                            // 'xl' => 5,
                            // '2xl' => 6,
                        ]),
                    Section::make('')
                        ->description('Prevent abuse by limiting the number of requests per period')
                        ->schema([
                            DateTimePicker::make('date')
                                ->required(),
                            TextInput::make('reference_no')
                                ->required()
                                ->maxLength(55),

                            TextInput::make('warehouse_id')
                                ->numeric(),
                        ])
                        ->inlineLabel()
                        ->grow(false),
                ])->from('lg'),




            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Penjualan List')
            ->columns([
                // TextColumn::make('relPenjualanDetail')
                // ->dateTime()
                //     ->sortable(),


                IconColumn::make('pos')
                    ->boolean(),
                TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('reference_no')
                    ->searchable(),
                TextColumn::make('customer')
                    ->searchable(),
                TextColumn::make('biller')
                    ->searchable(),
                TextColumn::make('warehouse_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('product_discount')
                    ->label('Product Disc')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order_discount_id')
                    ->label('Order Disc')
                    ->searchable(),
                TextColumn::make('total_discount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order_discount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('product_tax')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order_tax_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order_tax')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_tax')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('shipping')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sale_status')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->searchable(),
                TextColumn::make('payment_term')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_items')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('paid')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('return_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('surcharge')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('attachment')
                    ->searchable(),
                TextColumn::make('return_sale_ref')
                    ->searchable(),
                TextColumn::make('sale_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('return_sale_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rounding')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('suspend_note')
                    ->searchable(),
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
            RelationManagers\RelPenjualanDetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'view' => Pages\ViewPenjualan::route('/{record}'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
