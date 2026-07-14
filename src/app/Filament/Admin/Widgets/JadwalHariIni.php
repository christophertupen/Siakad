<?php

namespace App\Filament\Admin\Widgets;

use App\Models\JadwalPelajaran;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class JadwalHariIni extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => JadwalPelajaran::query()
                    ->with(['guru', 'kelas', 'mataPelajaran'])
                    ->where('hari', now()->locale('id')->isoFormat('dddd'))
                    ->orderBy('jam_mulai')
            )
            ->columns([
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Jam')
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-m-clock')
                    ->formatStateUsing(fn (JadwalPelajaran $record): string => sprintf(
                        '%s - %s',
                        \Carbon\Carbon::parse($record->jam_mulai)->format('H:i'),
                        \Carbon\Carbon::parse($record->jam_selesai)->format('H:i')
                    )),
                Tables\Columns\TextColumn::make('mataPelajaran.nama_mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->searchable(),
            ])
            ->paginated(false);
    }
}
