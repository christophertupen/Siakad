<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Absensi';

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'siswa.nama';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
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
                            ->relationship('jadwalPelajaran', 'hari')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwalPelajaran.kelas.nama_kelas')
                    ->label('Kelas')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mataPelajaran.nama_mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->badge(),

                Tables\Columns\TextColumn::make('jadwalPelajaran.guru.user.name')
                    ->label('Guru'),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Hadir',
                        'warning' => 'Izin',
                        'info' => 'Sakit',
                        'danger' => 'Alpha',
                    ]),

                Tables\Columns\TextColumn::make('keterangan')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('mata_pelajaran_id')
                    ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                    ->label('Mata Pelajaran'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                        'Alpha' => 'Alpha',
                    ]),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\DeleteBulkAction::make(),

                ]),

            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
