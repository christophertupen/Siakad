<?php

namespace App\Filament\OrangTua\Resources\RaporResource\Pages;

use App\Filament\OrangTua\Resources\RaporResource;
use Filament\Resources\Pages\ListRecords;

class ListRapors extends ListRecords
{
    protected static string $resource = RaporResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
