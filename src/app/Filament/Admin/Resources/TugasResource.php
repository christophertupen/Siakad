<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TugasResource\Pages;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Akademik';

    protected static ?string $navigationLabel = 'Tugas';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Tugas')
                    ->schema([

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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('mataPelajaran.nama_mata_pelajaran')
                    ->label('Mata Pelajaran')
                    ->badge()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas')
                    ->badge(),

                Tables\Columns\TextColumn::make('nilai_maksimal')
                    ->label('Nilai')
                    ->badge(),

                Tables\Columns\TextColumn::make('deadline')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y'),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('mata_pelajaran_id')
                    ->relationship('mataPelajaran', 'nama_mata_pelajaran')
                    ->label('Mata Pelajaran'),

                Tables\Filters\SelectFilter::make('kelas_id')
                    ->relationship('kelas', 'nama_kelas')
                    ->label('Kelas'),

                Tables\Filters\TernaryFilter::make('status')
                    ->label('Status'),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (Tugas $record) => filled($record->file_tugas))
                    ->url(fn (Tugas $record) => Storage::url($record->file_tugas))
                    ->openUrlInNewTab(),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
