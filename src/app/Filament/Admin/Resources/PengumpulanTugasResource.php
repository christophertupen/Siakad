<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PengumpulanTugasResource\Pages;
use App\Filament\Admin\Resources\PengumpulanTugasResource\RelationManagers;
use App\Models\PengumpulanTugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengumpulanTugasResource extends Resource
{
    protected static ?string $model = PengumpulanTugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tugas_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('siswa_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('file_jawaban')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('dikumpulkan_pada'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('siswa_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_jawaban')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dikumpulkan_pada')
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
