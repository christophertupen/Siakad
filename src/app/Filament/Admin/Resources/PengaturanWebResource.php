<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PengaturanWebResource\Pages;
use App\Models\PengaturanWeb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PengaturanWebResource extends Resource
{
    protected static ?string $model = PengaturanWeb::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Website';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Identitas Sekolah')
                    ->schema([

                        TextInput::make('nama_sekolah')
                            ->required(),

                        TextInput::make('nama_aplikasi')
                            ->required(),

                        TextInput::make('npsn'),

                        Select::make('jenjang')
                            ->options([
                                'SMK' => 'SMK',
                            ])
                            ->required(),

                        Select::make('status_sekolah')
                            ->options([
                                'Negeri' => 'Negeri',
                                'Swasta' => 'Swasta',
                            ]),

                        TextInput::make('akreditasi'),

                    ])
                    ->columns(2),

                Section::make('Kepala Sekolah')
                    ->schema([

                        TextInput::make('kepala_sekolah'),

                        TextInput::make('nip_kepala_sekolah'),

                    ])
                    ->columns(2),

                Section::make('Branding')
                    ->schema([

                        FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('pengaturan'),

                        FileUpload::make('favicon')
                            ->image()
                            ->disk('public')
                            ->directory('pengaturan'),

                        FileUpload::make('background_login')
                            ->image()
                            ->disk('public')
                            ->directory('pengaturan'),

                    ])
                    ->columns(3),

                Section::make('Kontak')
                    ->schema([

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('telepon'),

                        TextInput::make('website')
                            ->url(),

                        Textarea::make('alamat')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                Section::make('Profil Sekolah')
                    ->schema([

                        RichEditor::make('visi')
                            ->columnSpanFull(),

                        RichEditor::make('misi')
                            ->columnSpanFull(),

                        RichEditor::make('deskripsi')
                            ->columnSpanFull(),

                    ]),

                Section::make('Sosial Media')
                    ->schema([

                        TextInput::make('facebook'),

                        TextInput::make('instagram'),

                        TextInput::make('youtube'),

                        TextInput::make('tiktok'),

                        TextInput::make('whatsapp'),

                    ])
                    ->columns(2),

                Section::make('Website')
                    ->schema([

                        Textarea::make('google_maps')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('copyright'),

                        Toggle::make('maintenance_mode')
                            ->inline(false),

                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('logo')
                    ->circular(),

                TextColumn::make('nama_sekolah')
                    ->searchable(),

                TextColumn::make('nama_aplikasi')
                    ->searchable(),

                TextColumn::make('email'),

                TextColumn::make('telepon'),

                IconColumn::make('maintenance_mode')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->since(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturanWebs::route('/'),
            'create' => Pages\CreatePengaturanWeb::route('/create'),
            'edit' => Pages\EditPengaturanWeb::route('/{record}/edit'),
        ];
    }
}