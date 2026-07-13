<?php

namespace App\Filament\Admin\Resources\KelasSiswaResource\Pages;

use App\Filament\Admin\Resources\KelasSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKelasSiswas extends ListRecords
{
    protected static string $resource = KelasSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
