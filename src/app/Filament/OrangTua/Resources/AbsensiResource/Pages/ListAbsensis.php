<?php

namespace App\Filament\OrangTua\Resources\AbsensiResource\Pages;

use App\Filament\OrangTua\Resources\AbsensiResource;
use Filament\Resources\Pages\ListRecords;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
