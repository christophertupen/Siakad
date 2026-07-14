<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Admin\Resources\TugasResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class TugasResource extends AdminResource
{
    protected static ?string $navigationGroup = null;

    public static function getEloquentQuery(): Builder
    {
        $siswa = auth()->user()->siswa;
        $classIds = $siswa ? $siswa->kelasSiswas()->pluck('kelas_id') : collect();
        return parent::getEloquentQuery()
            ->whereIn('kelas_id', $classIds)
            ->where('status', true);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn ($record) => filled($record->file_tugas))
                    ->url(fn ($record) => \Illuminate\Support\Facades\Storage::url($record->file_tugas))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Siswa\Resources\TugasResource\Pages\ListTugas::route('/'),
        ];
    }
}
