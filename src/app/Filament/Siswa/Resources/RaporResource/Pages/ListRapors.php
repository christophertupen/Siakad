<?php

namespace App\Filament\Siswa\Resources\RaporResource\Pages;

use App\Filament\Siswa\Resources\RaporResource;
use Filament\Resources\Pages\ListRecords;

class ListRapors extends ListRecords
{
    protected static string $resource = RaporResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
