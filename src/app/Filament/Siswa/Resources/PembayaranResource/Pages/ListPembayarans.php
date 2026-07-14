<?php

namespace App\Filament\Siswa\Resources\PembayaranResource\Pages;

use App\Filament\Siswa\Resources\PembayaranResource;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
