<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\AbsensiResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Forms;

class AbsensiResource extends AdminResource
{
    protected static ?string $navigationGroup = 'Akademik';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('jadwalPelajaran', fn ($q) => $q->where('guru_id', auth()->user()->guru?->id));
    }

    public static function form(Form $form): Form
    {
        // For the Guru panel, let's limit the Jadwal Pelajaran dropdown to only the Guru's schedules
        return $form
            ->schema([
                Forms\Components\Section::make('Data Absensi')
                    ->schema([
                        Forms\Components\Select::make('siswa_id')
                            ->label('Siswa')
                            ->relationship('siswa', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('jadwal_pelajaran_id')
                            ->label('Jadwal Pelajaran')
                            ->relationship('jadwalPelajaran', 'hari', fn ($query) => $query->where('guru_id', auth()->user()->guru?->id))
                            ->getOptionLabelFromRecordUsing(function ($record) {
                                return $record->hari
                                    . ' | '
                                    . $record->kelas->nama_kelas
                                    . ' | '
                                    . $record->mataPelajaran->nama_mata_pelajaran
                                    . ' | '
                                    . $record->jam_mulai . ' - ' . $record->jam_selesai;
                            })
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->label('Mata Pelajaran')
                            ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal')
                            ->required()
                            ->default(now()),

                        Forms\Components\Select::make('status')
                            ->options([
                                'Hadir' => 'Hadir',
                                'Izin' => 'Izin',
                                'Sakit' => 'Sakit',
                                'Alpha' => 'Alpha',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('keterangan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Guru\Resources\AbsensiResource\Pages\ListAbsensis::route('/'),
            'create' => \App\Filament\Guru\Resources\AbsensiResource\Pages\CreateAbsensi::route('/create'),
            'edit' => \App\Filament\Guru\Resources\AbsensiResource\Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
