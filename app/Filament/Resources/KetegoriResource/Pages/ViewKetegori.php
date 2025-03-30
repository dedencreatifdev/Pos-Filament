<?php

namespace App\Filament\Resources\KetegoriResource\Pages;

use App\Filament\Resources\KetegoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKetegori extends ViewRecord
{
    protected static string $resource = KetegoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
