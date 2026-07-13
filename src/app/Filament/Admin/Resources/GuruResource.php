<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GuruResource\Pages;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Guru';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'nama',
            'nip',
            'bidang_keahlian',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Data Akun Guru')
                    ->schema([

                        TextInput::make('nama')
                            ->label('Nama Guru')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Login')
                            ->email()
                            ->required()
                            ->dehydrated(true)
                            ->visibleOn('create'),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->dehydrated(true)
                            ->visibleOn('create'),

                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->same('password')
                            ->required()
                            ->dehydrated(true)
                            ->visibleOn('create'),

                    ])
                    ->columns(2),

                Section::make('Data Guru')
                    ->schema([

                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('gelar')
                            ->label('Gelar'),

                        TextInput::make('pendidikan_terakhir')
                            ->label('Pendidikan Terakhir')
                            ->required(),

                        TextInput::make('bidang_keahlian')
                            ->label('Bidang Keahlian')
                            ->required(),

                        Toggle::make('confirmed')
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

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Guru')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('gelar')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pendidikan_terakhir')
                    ->badge(),

                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->badge(),

                Tables\Columns\IconColumn::make('confirmed')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),

            ])
            ->filters([

                Tables\Filters\TernaryFilter::make('confirmed')
                    ->label('Status'),

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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}