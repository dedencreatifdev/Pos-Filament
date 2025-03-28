<?php

namespace App\Filament\Resources\KetegoriResource\Pages;

use App\Filament\Resources\KetegoriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKetegori extends CreateRecord
{
    protected static string $resource = KetegoriResource::class;
    protected static bool $canCreateAnother = false;

    // Redirect
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
