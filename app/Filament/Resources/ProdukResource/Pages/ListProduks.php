<?php

namespace App\Filament\Resources\ProdukResource\Pages;

use App\Filament\Resources\ProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProduks extends ListRecords
{
    protected static string $resource = ProdukResource::class;
    // protected static ?string $title = 'Page Title';
    // protected ?string $subheading = 'Custom Page Subheading';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus-circle')
            ,
        ];
    }
}
