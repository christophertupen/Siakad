<?php

namespace App\Filament\Admin\Resources\JadwalPelajaranResource\Pages;

use App\Filament\Admin\Resources\JadwalPelajaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPelajaran extends EditRecord
{
    protected static string $resource = JadwalPelajaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
