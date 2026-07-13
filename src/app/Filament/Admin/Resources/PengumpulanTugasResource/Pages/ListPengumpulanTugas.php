<?php

namespace App\Filament\Admin\Resources\PengumpulanTugasResource\Pages;

use App\Filament\Admin\Resources\PengumpulanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengumpulanTugas extends ListRecords
{
    protected static string $resource = PengumpulanTugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
