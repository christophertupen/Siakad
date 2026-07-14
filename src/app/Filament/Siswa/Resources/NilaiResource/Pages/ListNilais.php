<?php

namespace App\Filament\Siswa\Resources\NilaiResource\Pages;

use App\Filament\Siswa\Resources\NilaiResource;
use Filament\Resources\Pages\ListRecords;

class ListNilais extends ListRecords
{
    protected static string $resource = NilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
