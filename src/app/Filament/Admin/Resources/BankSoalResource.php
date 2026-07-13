<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BankSoalResource\Pages;
use App\Models\BankSoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class BankSoalResource extends Resource
{
    protected static ?string $model = BankSoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Bank Soal';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Bank Soal')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('judul')
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

                Tables\Columns\TextColumn::make('semester')
                    ->badge(),

                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_publish')
                    ->label('Publish')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->date('d M Y')
                    ->sortable(),

            ])

            ->filters([

                Tables\Filters\SelectFilter::make('kelas')
                    ->relationship('kelas', 'nama_kelas'),

                Tables\Filters\SelectFilter::make('mata_pelajaran')
                    ->relationship('mataPelajaran', 'nama_mata_pelajaran'),

                Tables\Filters\TernaryFilter::make('is_publish')
                    ->label('Publish'),

            ])

            ->actions([

                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn (BankSoal $record) => Storage::url($record->file))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListBankSoals::route('/'),
            'create' => Pages\CreateBankSoal::route('/create'),
            'edit' => Pages\EditBankSoal::route('/{record}/edit'),
        ];
    }
}
