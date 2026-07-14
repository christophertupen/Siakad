<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\Admin\Resources\RaporResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class RaporResource extends AdminResource
{
    protected static ?string $navigationGroup = null;

    protected static ?string $navigationLabel = 'Rapor Anak';

    public static function getEloquentQuery(): Builder
    {
        $orangTua = auth()->user()->orangTua;
        return parent::getEloquentQuery()
            ->where('siswa_id', $orangTua?->siswa_id);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => \Illuminate\Support\Facades\Storage::url($record->file_pdf))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => filled($record->file_pdf)),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\OrangTua\Resources\RaporResource\Pages\ListRapors::route('/'),
        ];
    }
}
