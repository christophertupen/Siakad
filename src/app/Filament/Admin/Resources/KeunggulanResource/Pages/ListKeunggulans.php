<?php

namespace App\Filament\Admin\Resources\KeunggulanResource\Pages;

use App\Filament\Admin\Resources\KeunggulanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeunggulans extends ListRecords
{
    protected static string $resource = KeunggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
