<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RaporResource\Pages;
use App\Models\Nilai;
use App\Models\Rapor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RaporResource extends Resource
{
    protected static ?string $model = Rapor::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Rapor';

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'siswa.nama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Rapor')
                    ->schema([

                        Forms\Components\Select::make('siswa_id')
                            ->label('Siswa')
                            ->relationship('siswa', 'nama')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set))
                            ->required(),

                        Forms\Components\Select::make('guru_id')
                            ->label('Wali Kelas')
                            ->relationship('guru', 'nip')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name)
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->placeholder('2026/2027')
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set))
                            ->required(),

                        Forms\Components\Select::make('semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap' => 'Genap',
                            ])
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set))
                            ->required(),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Hasil Perhitungan')
                    ->schema([

                        Forms\Components\TextInput::make('total_nilai')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('rata_rata')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('peringkat')
                            ->numeric(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'Naik' => 'Naik',
                                'Tidak Naik' => 'Tidak Naik',
                                'Lulus' => 'Lulus',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('catatan_wali_kelas')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file_pdf')
                            ->directory('rapor')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->downloadable(),

                    ])
                    ->columns(2),

            ]);
    }

    protected static function hitungNilai(Get $get, Set $set): void
    {
        if (
            blank($get('siswa_id')) ||
            blank($get('semester')) ||
            blank($get('tahun_ajaran'))
        ) {
            return;
        }

        $nilai = Nilai::query()
            ->where('siswa_id', $get('siswa_id'))
            ->where('semester', $get('semester'))
            ->where('tahun_ajaran', $get('tahun_ajaran'))
            ->get();

        if ($nilai->isEmpty()) {
            $set('total_nilai', 0);
            $set('rata_rata', 0);
            return;
        }

        $set('total_nilai', $nilai->sum('nilai_akhir'));
        $set('rata_rata', round($nilai->avg('nilai_akhir'), 2));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('siswa.nama')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('guru.user.name')
                    ->label('Wali Kelas'),

                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('semester')
                    ->colors([
                        'success' => 'Ganjil',
                        'warning' => 'Genap',
                    ]),

                Tables\Columns\TextColumn::make('total_nilai')
                    ->label('Total'),

                Tables\Columns\TextColumn::make('rata_rata')
                    ->label('Rata-rata'),

                Tables\Columns\TextColumn::make('peringkat')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'Lulus',
                        'primary' => 'Naik',
                        'danger' => 'Tidak Naik',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
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
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRapors::route('/'),
            'create' => Pages\CreateRapor::route('/create'),
            'edit' => Pages\EditRapor::route('/{record}/edit'),
        ];
    }
}
