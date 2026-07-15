<?php

namespace App\Filament\Admin\Resources\FiturAkademikResource\Pages;

use App\Filament\Admin\Resources\FiturAkademikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiturAkademiks extends ListRecords
{
    protected static string $resource = FiturAkademikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
