<?php

namespace App\Filament\Admin\Resources\KontenWebResource\Pages;

use App\Filament\Admin\Resources\KontenWebResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKontenWeb extends EditRecord
{
    protected static string $resource = KontenWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
