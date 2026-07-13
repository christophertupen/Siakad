<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MateriResource\Pages;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Materi';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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

                        Forms\Components\Select::make('guru_id')
                            ->label('Guru')
                            ->relationship('guru', 'nama')
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
                    ->searchable(),

                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->badge(),

                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->label('Tanggal')
                    ->date('d M Y'),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('mata_pelajaran_id')
                    ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                    ->label('Mata Pelajaran'),

                Tables\Filters\SelectFilter::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->label('Guru'),

                Tables\Filters\SelectFilter::make('kelas_id')
                    ->relationship('kelas', 'nama_kelas')
                    ->label('Kelas'),

                Tables\Filters\TernaryFilter::make('status'),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (Materi $record) => Storage::url($record->file))
                    ->openUrlInNewTab()
                    ->visible(fn (Materi $record) => filled($record->file)),

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
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}