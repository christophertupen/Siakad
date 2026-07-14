<?php

namespace App\Filament\Siswa\Resources\MateriResource\Pages;

use App\Filament\Siswa\Resources\MateriResource;
use Filament\Resources\Pages\ListRecords;

class ListMateris extends ListRecords
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
