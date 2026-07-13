<?php

namespace App\Filament\Admin\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Admin\Resources\JadwalPelajaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPelajarans extends ListRecords
{
    protected static string $resource = JadwalPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
