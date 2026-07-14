<?php

namespace App\Filament\OrangTua\Resources\PembayaranResource\Pages;

use App\Filament\OrangTua\Resources\PembayaranResource;
use Filament\Resources\Pages\ListRecords;

class ListPembayarans extends ListRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
