<?php

namespace App\Filament\Admin\Resources\KeunggulanResource\Pages;

use App\Filament\Admin\Resources\KeunggulanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKeunggulan extends EditRecord
{
    protected static string $resource = KeunggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
