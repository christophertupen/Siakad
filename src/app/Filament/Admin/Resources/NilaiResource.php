<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NilaiResource\Pages;
use App\Models\Nilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Nilai';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'siswa.nama';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Nilai')
                    ->schema([

                        Forms\Components\Select::make('siswa_id')
                            ->label('Siswa')
                            ->relationship('siswa', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('guru_id')
                            ->relationship('guru', 'nip')
                            ->getOptionLabelFromRecordUsing(
                                fn ($record) => $record->user->name
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->relationship(
                                'mataPelajaran',
                                'nama_mata_pelajaran'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('nilai_tugas')
                            ->numeric()
                            ->minvalue(0)
                            ->maxvalue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::hitungNilai($get, $set)),

                        Forms\Components\TextInput::make('nilai_uts')
                            ->numeric()
                            ->minvalue(0)
                            ->maxvalue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::hitungNilai($get, $set)),

                        Forms\Components\TextInput::make('nilai_uas')
                            ->numeric()
                            ->minvalue(0)
                            ->maxvalue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::hitungNilai($get, $set)),

                        Forms\Components\TextInput::make('nilai_akhir')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('predikat')
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->required()
                            ->placeholder('2026/2027'),

                        Forms\Components\Select::make('semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap' => 'Genap',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('catatan')
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

            ]);
    }

    protected static function hitungNilai(Get $get, Set $set): void
    {
        $tugas = (float) $get('nilai_tugas' ?? 0);
        $uts = (float) $get('nilai_uts' ?? 0);
        $uas = (float) $get('nilai_uas' ?? 0);

        if ($tugas || $uts || $uas) {

            $akhir = round(($tugas + $uts + $uas) / 3);

            $set('nilai_akhir', $akhir);

            if ($akhir >= 90) {
                $set('predikat', 'A');
            } elseif ($akhir >= 80) {
                $set('predikat', 'B');
            } elseif ($akhir >= 70) {
                $set('predikat', 'C');
            } else {
                $set('predikat', 'D');
            }
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('siswa.nis')
                    ->label('NIS'),

                Tables\Columns\TextColumn::make('guru.user.name')
                    ->label('Guru')
                    ->searchable(),

                Tables\Columns\TextColumn::make('mataPelajaran.nama_mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nilai_tugas'),

                Tables\Columns\TextColumn::make('nilai_uts'),

                Tables\Columns\TextColumn::make('nilai_uas'),

                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->badge()
                    ->color('success'),

                Tables\Columns\BadgeColumn::make('predikat')
                    ->colors([
                        'success' => 'A',
                        'primary' => 'B',
                        'warning' => 'C',
                        'danger' => 'D',
                    ]),

                Tables\Columns\BadgeColumn::make('semester')
                    ->colors([
                        'success' => 'Ganjil',
                        'warning' => 'Genap',
                    ]),

                Tables\Columns\TextColumn::make('tahun_ajaran'),

                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        'Ganjil' => 'Ganjil',
                        'Genap' => 'Genap',
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }
}
