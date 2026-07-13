<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MataPelajaranResource\Pages;
use App\Models\MataPelajaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MataPelajaranResource extends Resource
{
    protected static ?string $model = MataPelajaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Mata Pelajaran';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'nama_mata_pelajaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Mata Pelajaran')
                    ->schema([

                        Forms\Components\TextInput::make('kode_mata_pelajaran')
                            ->label('Kode Mata Pelajaran')
                            ->required()
                            ->unique(
                                table: MataPelajaran::class,
                                column: 'kode_mata_pelajaran',
                                ignoreRecord: true
                            )
                            ->maxLength(50),

                        Forms\Components\TextInput::make('nama_mata_pelajaran')
                            ->label('Nama Mata Pelajaran')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('kkm')
                            ->label('KKM')
                            ->numeric()
                            ->default(75)
                            ->required(),

                        Forms\Components\Toggle::make('status')
                            ->label('Status Aktif')
                            ->default(true),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('kode_mata_pelajaran')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_mata_pelajaran')
                    ->label('Nama Mata Pelajaran')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kkm')
                    ->badge(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(40),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),

            ])
            ->filters([

                Tables\Filters\TernaryFilter::make('status')
                    ->label('Status'),

            ])
            ->actions([

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
            'index' => Pages\ListMataPelajarans::route('/'),
            'create' => Pages\CreateMataPelajaran::route('/create'),
            'edit' => Pages\EditMataPelajaran::route('/{record}/edit'),
        ];
    }
}