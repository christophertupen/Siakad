<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\NilaiResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;

class NilaiResource extends AdminResource
{
    protected static ?string $navigationGroup = 'Akademik';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('guru_id', auth()->user()->guru?->id);
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

                        Forms\Components\Hidden::make('guru_id')
                            ->default(fn () => auth()->user()->guru?->id),

                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('nilai_tugas')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set)),

                        Forms\Components\TextInput::make('nilai_uts')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set)),

                        Forms\Components\TextInput::make('nilai_uas')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::hitungNilai($get, $set)),

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

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Guru\Resources\NilaiResource\Pages\ListNilais::route('/'),
            'create' => \App\Filament\Guru\Resources\NilaiResource\Pages\CreateNilai::route('/create'),
            'edit' => \App\Filament\Guru\Resources\NilaiResource\Pages\EditNilai::route('/{record}/edit'),
        ];
    }
}
