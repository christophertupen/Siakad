<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')->schema([
                    Forms\Components\Select::make('user_id')->relationship('user', 'name')->searchable()->preload(),
                    Forms\Components\TextInput::make('nis')->required()->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('nisn')->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('nama')->required()->maxLength(255),
                    Forms\Components\Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->required(),
                    Forms\Components\TextInput::make('tempat_lahir'),
                    Forms\Components\DatePicker::make('tanggal_lahir'),
                    Forms\Components\TextInput::make('agama'),
                    Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                    Forms\Components\TextInput::make('nomor_hp')->tel(),
                    Forms\Components\DatePicker::make('tanggal_masuk')->required(),
                    Forms\Components\Toggle::make('status')->default(true),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nis')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nisn')->searchable(),
                Tables\Columns\TextColumn::make('nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('nomor_hp'),
                Tables\Columns\IconColumn::make('status')->boolean(),
            ])
            ->filters([Tables\Filters\TernaryFilter::make('status')])
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
