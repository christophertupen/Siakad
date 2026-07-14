<?php

namespace App\Filament\Siswa\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Siswa\Resources\JadwalPelajaranResource;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPelajarans extends ListRecords
{
    protected static string $resource = JadwalPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
