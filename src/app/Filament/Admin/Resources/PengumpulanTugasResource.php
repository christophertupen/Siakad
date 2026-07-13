<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PengumpulanTugasResource\Pages;
use App\Models\PengumpulanTugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengumpulanTugasResource extends Resource
{
    protected static ?string $model = PengumpulanTugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';
    protected static ?string $navigationGroup = 'Akademik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tugas_id')->relationship('tugas', 'judul')->searchable()->preload()->required(),
                Forms\Components\Select::make('siswa_id')->relationship('siswa', 'nama')->searchable()->preload()->required(),
                Forms\Components\FileUpload::make('file_jawaban')->directory('pengumpulan-tugas'),
                Forms\Components\DateTimePicker::make('tanggal_pengumpulan')->required(),
                Forms\Components\TextInput::make('nilai')->numeric(),
                Forms\Components\Textarea::make('catatan')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas.judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('siswa.nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('file_jawaban')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pengumpulan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPengumpulanTugas::route('/'),
            'create' => Pages\CreatePengumpulanTugas::route('/create'),
            'edit' => Pages\EditPengumpulanTugas::route('/{record}/edit'),
        ];
    }
}
