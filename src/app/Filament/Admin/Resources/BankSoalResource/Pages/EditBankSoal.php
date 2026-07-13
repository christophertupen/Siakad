<?php

namespace App\Filament\Admin\Resources\BankSoalResource\Pages;

use App\Filament\Admin\Resources\BankSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankSoal extends EditRecord
{
    protected static string $resource = BankSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
