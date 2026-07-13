<?php

namespace App\Filament\Admin\Resources\PengumpulanTugasResource\Pages;

use App\Filament\Admin\Resources\PengumpulanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengumpulanTugas extends EditRecord
{
    protected static string $resource = PengumpulanTugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
