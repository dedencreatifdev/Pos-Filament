<?php

namespace App\Filament\Resources\KetegoriResource\Pages;

use App\Filament\Resources\KetegoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKetegori extends EditRecord
{
    protected static string $resource = KetegoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
                        Actions\DeleteAction::make(),
        ];
    }

    // Redirect
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
