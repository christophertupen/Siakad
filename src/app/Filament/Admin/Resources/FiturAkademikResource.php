<?php

namespace App\Filament\Admin\Resources;

use App\Models\FiturAkademik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Admin\Resources\FiturAkademikResource\Pages;

class FiturAkademikResource extends Resource
{
    protected static ?string $model = FiturAkademik::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Academic Features';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Fitur Akademik')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Fitur')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('icon')
                            ->label('Icon (Class FontAwesome)')
                            ->placeholder('contoh: fa-chart-simple, fa-bell, fa-comments')
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3),
                        FileUpload::make('image')
                            ->label('Gambar / Screenshot Widget')
                            ->image()
                            ->disk('public')
                            ->directory('website')
                            ->placeholder('Opsional untuk visualisasi bento grid'),
                        TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Toggle::make('status')
                            ->label('Aktif / Tampilkan')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Gambar/Widget')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('icon')
                    ->label('Ikon'),
                IconColumn::make('status')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiturAkademiks::route('/'),
            'create' => Pages\CreateFiturAkademik::route('/create'),
            'edit' => Pages\EditFiturAkademik::route('/{record}/edit'),
        ];
    }
}
