<?php

namespace App\Filament\Guru\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Guru\Resources\JadwalPelajaranResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPelajarans extends ListRecords
{
    protected static string $resource = JadwalPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
