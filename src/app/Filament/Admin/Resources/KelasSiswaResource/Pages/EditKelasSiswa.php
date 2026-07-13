<?php

namespace App\Filament\Admin\Resources\KelasSiswaResource\Pages;

use App\Filament\Admin\Resources\KelasSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKelasSiswa extends EditRecord
{
    protected static string $resource = KelasSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
