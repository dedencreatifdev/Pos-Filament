<?php

namespace App\Filament\Resources\KetegoriResource\Pages;

use App\Filament\Resources\KetegoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKetegoris extends ListRecords
{
    protected static string $resource = KetegoriResource::class;
    // protected static ?string $title = 'Page Title';
    // protected ?string $subheading = 'Custom Page Subheading';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Ketegori')
                ->icon('heroicon-o-plus-circle'),
        ];
    }
}
