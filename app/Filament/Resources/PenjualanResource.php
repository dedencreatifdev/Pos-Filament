<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\Penjualan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('reference_no')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('customer')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('biller_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('biller')
                    ->required()
                    ->maxLength(55),
                Forms\Components\TextInput::make('warehouse_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('staff_note')
                    ->maxLength(1000)
                    ->default(null),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('product_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_discount_id')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('total_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_discount')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('product_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('order_tax_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('order_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('total_tax')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('shipping')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('grand_total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sale_status')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('payment_status')
                    ->maxLength(20)
                    ->default(null),
                Forms\Components\TextInput::make('payment_term')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('due_date'),
                Forms\Components\TextInput::make('created_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_items')
                    ->numeric()
                    ->default(null),
                Forms\Components\Toggle::make('pos')
                    ->required(),
                Forms\Components\TextInput::make('paid')
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('return_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('surcharge')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('attachment')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('return_sale_ref')
                    ->maxLength(55)
                    ->default(null),
                Forms\Components\TextInput::make('sale_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('return_sale_total')
                    ->required()
                    ->numeric()
                    ->default(0.0000),
                Forms\Components\TextInput::make('rounding')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('suspend_note')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()

                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('biller_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('biller')
                    ->searchable(),
                Tables\Columns\TextColumn::make('warehouse_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->searchable(),
                Tables\Columns\TextColumn::make('staff_note')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_discount_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_tax')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_tax_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_tax')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_tax')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_term')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_items')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('pos')
                    ->boolean(),
                Tables\Columns\TextColumn::make('paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('surcharge')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attachment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('return_sale_ref')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sale_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_sale_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rounding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('suspend_note')
                    ->searchable(),
            ])
            ->defaultSort('date', 'desc')
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'view' => Pages\ViewPenjualan::route('/{record}'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
