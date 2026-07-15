<?php

namespace App\Filament\Admin\Resources\FiturAkademikResource\Pages;

use App\Filament\Admin\Resources\FiturAkademikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiturAkademik extends EditRecord
{
    protected static string $resource = FiturAkademikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
