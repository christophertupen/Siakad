<?php

namespace App\Filament\Siswa\Resources\TugasResource\Pages;

use App\Filament\Siswa\Resources\TugasResource;
use Filament\Resources\Pages\ListRecords;

class ListTugas extends ListRecords
{
    protected static string $resource = TugasResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
