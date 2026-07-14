<?php

namespace App\Filament\Siswa\Resources;

use App\Filament\Admin\Resources\NilaiResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;

class NilaiResource extends AdminResource
{
    protected static ?string $navigationGroup = null;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('siswa_id', auth()->user()->siswa?->id);
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
            'index' => \App\Filament\Siswa\Resources\NilaiResource\Pages\ListNilais::route('/'),
        ];
    }
}
