<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KelasSiswaResource\Pages;
use App\Models\KelasSiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KelasSiswaResource extends Resource
{
    protected static ?string $model = KelasSiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Kelas Siswa';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'siswa.nama';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Siswa')
                    ->schema([

                        Forms\Components\Select::make('siswa_id')
                            ->relationship('siswa', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('kelas_id')
                            ->relationship('kelas', 'nama_kelas')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('no_absen')
                            ->numeric(),

                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->placeholder('2026/2027')
                            ->required(),

                        Forms\Components\Select::make('semester')
                            ->options([
                                'Ganjil' => 'Ganjil',
                                'Genap' => 'Genap',
                            ])
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->default(true),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('siswa.nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('siswa.nis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kelas.nama_kelas')
                    ->label('Kelas'),

                Tables\Columns\TextColumn::make('no_absen'),

                Tables\Columns\TextColumn::make('tahun_ajaran'),

                Tables\Columns\BadgeColumn::make('semester'),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y'),

            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status'),
            ])
            ->actions([
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelasSiswas::route('/'),
            'create' => Pages\CreateKelasSiswa::route('/create'),
            'edit' => Pages\EditKelasSiswa::route('/{record}/edit'),
        ];
    }
}
