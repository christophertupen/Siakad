<?php

namespace App\Filament\Admin\Resources\PengaturanWebResource\Pages;

use App\Filament\Admin\Resources\PengaturanWebResource;
use App\Models\PengaturanWeb;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanWebs extends ListRecords
{
    protected static string $resource = PengaturanWebResource::class;

    protected function getHeaderActions(): array
    {
        return PengaturanWeb::count() === 0
            ? [
                Actions\CreateAction::make()
                    ->label('Buat Pengaturan'),
            ]
            : [];
    }
}