<?php

namespace App\Filament\Admin\Resources\OrangTuaResource\Pages;

use App\Filament\Admin\Resources\OrangTuaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrangTuas extends ListRecords
{
    protected static string $resource = OrangTuaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
