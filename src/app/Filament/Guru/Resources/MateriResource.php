<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\MateriResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Forms;

class MateriResource extends AdminResource
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
                Forms\Components\Section::make('Data Materi')
                    ->schema([
                        Forms\Components\Select::make('mata_pelajaran_id')
                            ->label('Mata Pelajaran')
                            ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Hidden::make('guru_id')
                            ->default(fn () => auth()->user()->guru?->id),

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

                        Forms\Components\FileUpload::make('file')
                            ->label('File Materi')
                            ->directory('materi')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-powerpoint',
                                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            ]),

                        Forms\Components\DatePicker::make('tanggal_dibuat')
                            ->label('Tanggal Dibuat')
                            ->default(now())
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->label('Publish')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Guru\Resources\MateriResource\Pages\ListMateris::route('/'),
            'create' => \App\Filament\Guru\Resources\MateriResource\Pages\CreateMateri::route('/create'),
            'edit' => \App\Filament\Guru\Resources\MateriResource\Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}
