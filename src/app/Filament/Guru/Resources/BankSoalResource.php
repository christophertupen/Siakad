<?php

namespace App\Filament\Guru\Resources;

use App\Filament\Admin\Resources\BankSoalResource as AdminResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Forms;

class BankSoalResource extends AdminResource
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
                Forms\Components\Section::make('Data Bank Soal')
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
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file')
                            ->label('File Soal')
                            ->disk('public')
                            ->directory('bank-soal')
                            ->downloadable()
                            ->openable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            ])
                            ->required(),

                        Forms\Components\Select::make('semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap' => 'Genap',
                            ])
                            ->required(),

                        Forms\Components\Toggle::make('is_publish')
                            ->label('Publish')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Guru\Resources\BankSoalResource\Pages\ListBankSoals::route('/'),
            'create' => \App\Filament\Guru\Resources\BankSoalResource\Pages\CreateBankSoal::route('/create'),
            'edit' => \App\Filament\Guru\Resources\BankSoalResource\Pages\EditBankSoal::route('/{record}/edit'),
        ];
    }
}
