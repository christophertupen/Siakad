<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JadwalPelajaranResource\Pages;
use App\Models\JadwalPelajaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalPelajaranResource extends Resource
{
    protected static ?string $model = JadwalPelajaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Jadwal Pelajaran';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'hari';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Jadwal Pelajaran')
                    ->schema([

                        Forms\Components\Select::make('guru_id')
                            ->label('Guru')
                            ->relationship('guru', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->label('Mata Pelajaran')
                            ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('kelas_id')
                            ->label('Kelas')
                            ->relationship('kelas', 'nama_kelas')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('hari')
                            ->required()
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                            ]),

                        Forms\Components\TimePicker::make('jam_mulai')
                            ->required()
                            ->seconds(false),

                        Forms\Components\TimePicker::make('jam_selesai')
                            ->required()
                            ->seconds(false),

                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->placeholder('2026/2027')
                            ->required(),

                        Forms\Components\Select::make('semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap' => 'Genap',
                            ])
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Aktif')
                            ->default(true),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mataPelajaran.nama_mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->badge()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('hari')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Mulai')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Selesai')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('semester')
                    ->badge(),

                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('guru')
                    ->relationship('guru', 'nama'),

                Tables\Filters\SelectFilter::make('kelas')
                    ->relationship('kelas', 'nama_kelas'),

                Tables\Filters\SelectFilter::make('mata_pelajaran')
                    ->relationship('mataPelajaran', 'nama_mata_pelajaran'),

                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        'Ganjil' => 'Ganjil',
                        'Genap' => 'Genap',
                    ]),

                Tables\Filters\TernaryFilter::make('status'),

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
            'index' => Pages\ListJadwalPelajarans::route('/'),
            'create' => Pages\CreateJadwalPelajaran::route('/create'),
            'edit' => Pages\EditJadwalPelajaran::route('/{record}/edit'),
        ];
    }
}