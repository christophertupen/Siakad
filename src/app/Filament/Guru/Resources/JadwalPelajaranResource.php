<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\JadwalPelajaranResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class JadwalPelajaranResource extends AdminResource
{
    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Jadwal Mengajar';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('guru_id', auth()->user()->guru?->id);
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
            'index' => \App\Filament\Guru\Resources\JadwalPelajaranResource\Pages\ListJadwalPelajarans::route('/'),
        ];
    }
}
