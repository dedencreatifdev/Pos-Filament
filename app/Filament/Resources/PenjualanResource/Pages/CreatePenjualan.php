<?php

namespace App\Filament\Resources\PenjualanResource\Pages;

use App\Filament\Resources\PenjualanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;
    protected static bool $canCreateAnother = false;

    // Redirect
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
