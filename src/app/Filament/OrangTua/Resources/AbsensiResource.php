<?php

namespace App\Filament\OrangTua\Resources;

use App\Filament\Admin\Resources\AbsensiResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class AbsensiResource extends AdminResource
{
    protected static ?string $navigationGroup = null;

    protected static ?string $navigationLabel = 'Absensi Anak';

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
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\OrangTua\Resources\AbsensiResource\Pages\ListAbsensis::route('/'),
        ];
    }
}
