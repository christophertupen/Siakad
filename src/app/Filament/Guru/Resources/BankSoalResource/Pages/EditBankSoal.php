<?php

namespace App\Filament\Guru\Resources\BankSoalResource\Pages;

use App\Filament\Guru\Resources\BankSoalResource;
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
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
