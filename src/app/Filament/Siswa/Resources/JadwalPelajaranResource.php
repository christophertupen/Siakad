<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Admin\Resources\JadwalPelajaranResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class JadwalPelajaranResource extends AdminResource
{
    protected static ?string $navigationGroup = null;
    protected static bool $shouldRegisterNavigation = false;

    public static function getEloquentQuery(): Builder
    {
        $siswa = auth()->user()->siswa;
        $classIds = $siswa ? $siswa->kelasSiswas()->pluck('kelas_id') : collect();
        return parent::getEloquentQuery()
            ->whereIn('kelas_id', $classIds);
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
            'index' => \App\Filament\Siswa\Resources\JadwalPelajaranResource\Pages\ListJadwalPelajarans::route('/'),
        ];
    }
}
