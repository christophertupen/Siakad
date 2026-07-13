<?php

namespace App\Filament\Admin\Resources\BankSoalResource\Pages;

use App\Filament\Admin\Resources\BankSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankSoals extends ListRecords
{
    protected static string $resource = BankSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
