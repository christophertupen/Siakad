<?php

namespace App\Filament\Guru\Resources\BankSoalResource\Pages;

use App\Filament\Guru\Resources\BankSoalResource;
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
