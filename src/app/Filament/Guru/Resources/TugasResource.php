<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\TugasResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Forms;

class TugasResource extends AdminResource
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
                Forms\Components\Section::make('Data Tugas')
                    ->schema([
                        Forms\Components\Hidden::make('guru_id')
                            ->default(fn () => auth()->user()->guru?->id),

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

                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(5)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file_tugas')
                            ->label('File Tugas')
                            ->disk('public')
                            ->directory('tugas')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ]),

                        Forms\Components\TextInput::make('nilai_maksimal')
                            ->label('Nilai Maksimal')
                            ->numeric()
                            ->default(100)
                            ->required(),

                        Forms\Components\DateTimePicker::make('deadline')
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Guru\Resources\TugasResource\Pages\ListTugas::route('/'),
            'create' => \App\Filament\Guru\Resources\TugasResource\Pages\CreateTugas::route('/create'),
            'edit' => \App\Filament\Guru\Resources\TugasResource\Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
