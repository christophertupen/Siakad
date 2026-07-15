<?php

namespace App\Filament\Admin\Resources;

use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Admin\Resources\BeritaResource\Pages;
use Illuminate\Support\Str;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Berita')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Grid::make(3)->schema([
                            TextInput::make('kategori')
                                ->label('Kategori')
                                ->default('Umum')
                                ->required(),
                            DatePicker::make('tanggal')
                                ->label('Tanggal Publish')
                                ->default(now())
                                ->required(),
                            TextInput::make('author')
                                ->label('Penulis / Author')
                                ->default(fn () => auth()->user()->name)
                                ->required(),
                        ]),
                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required(),
                    ]),

                Section::make('Media & Pengaturan')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail Image')
                            ->image()
                            ->disk('public')
                            ->directory('news')
                            ->placeholder('Gambar berita'),
                        Grid::make(2)->schema([
                            Toggle::make('status_publish')
                                ->label('Terbitkan Berita')
                                ->default(true),
                            Toggle::make('featured')
                                ->label('Jadikan Berita Utama (Featured)')
                                ->default(false),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                TextColumn::make('author')
                    ->label('Author')
                    ->sortable(),
                IconColumn::make('status_publish')
                    ->label('Publikasi')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('featured')
                    ->label('Utama')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
