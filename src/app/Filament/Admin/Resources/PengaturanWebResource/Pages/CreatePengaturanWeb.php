<?php

namespace App\Filament\Admin\Resources\PengaturanWebResource\Pages;

use App\Filament\Admin\Resources\PengaturanWebResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengaturanWeb extends CreateRecord
{
    protected static string $resource = PengaturanWebResource::class;

    protected function getRedirectUrl(): string
    {
        return PengaturanWebResource::getUrl('edit', [
            'record' => $this->record,
        ]);
    }
}