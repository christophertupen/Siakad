<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Admin\Resources\PembayaranResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class PembayaranResource extends AdminResource
{
    protected static ?string $navigationGroup = null;
    protected static bool $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('siswa_id', auth()->user()->siswa?->id);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->actions([
                Tables\Actions\Action::make('pay')
                    ->label('Bayar')
                    ->icon('heroicon-o-credit-card')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'Pending')
                    ->url(fn ($record) => route('midtrans.pay', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('checkStatus')
                    ->label('Cek Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->visible(fn ($record) => filled($record->midtrans_order_id) && $record->status === 'Pending')
                    ->action(function ($record) {
                        $service = app(\App\Services\MidtransService::class);
                        $status = $service->checkStatus($record);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Status Pembayaran')
                            ->body('Status saat ini di Midtrans: ' . $status)
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Siswa\Resources\PembayaranResource\Pages\ListPembayarans::route('/'),
        ];
    }
}
