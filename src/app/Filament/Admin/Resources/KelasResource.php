<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KelasResource\Pages;
use App\Models\Kelas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Kelas';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'nama_kelas';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Kelas')
                    ->schema([

                        Forms\Components\TextInput::make('nama_kelas')
                            ->label('Nama Kelas')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(100),

                        Forms\Components\Select::make('tingkat')
                            ->options([
                                'X' => 'X',
                                'XI' => 'XI',
                                'XII' => 'XII',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->placeholder('2026/2027')
                            ->required(),

                        Forms\Components\Select::make('wali_kelas_id')
                            ->relationship('waliKelas', 'nama')
                            ->searchable()
                            ->preload()
                            ->nullable(),

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

                Tables\Columns\TextColumn::make('nama_kelas')
                    ->label('Nama Kelas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tingkat')
                    ->badge(),

                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->sortable(),
    
                Tables\Columns\TextColumn::make('waliKelas.nama')
                    ->label('Wali Kelas')
                    ->placeholder('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kelasSiswa_count')
                    ->label('jumlah Siswa')
                    ->counts('siswa')
                    ->badge(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('tingkat')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ]),

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
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
        ];
    }
}