<?php

namespace App\Filament\Admin\Resources\PengaturanWebResource\Pages;

use App\Filament\Admin\Resources\PengaturanWebResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanWeb extends EditRecord
{
    protected static string $resource = PengaturanWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada DeleteAction
        ];
    }
}