<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = -2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'email',
            'nis',
            'nip',
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Email' => $record->email,
            'Role' => $record->role,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Pengguna')
                    ->schema([

                        Forms\Components\FileUpload::make('avatar_url')
                            ->label('Avatar')
                            ->image()
                            ->directory('avatar')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('role')
                            ->label('Role')
                            ->options([
                                'admin' => 'Admin',
                                'akademik' => 'Akademik',
                                'guru' => 'Guru',
                                'siswa' => 'Siswa',
                                'orang_tua' => 'Orang Tua',
                            ])
                            ->live()
                            ->required(),

                        Forms\Components\TextInput::make('nis')
                            ->label('NIS')
                            ->visible(fn (Get $get) => $get('role') === 'siswa')
                            ->required(fn (Get $get) => $get('role') === 'siswa')
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->visible(fn (Get $get) => $get('role') === 'guru')
                            ->required(fn (Get $get) => $get('role') === 'guru')
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('jenis_kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),

                        Forms\Components\DatePicker::make('tanggal_lahir'),

                        Forms\Components\TextInput::make('nomor_telepon')
                            ->tel(),

                        Forms\Components\Textarea::make('alamat')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('status')
                            ->default(true),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->confirmed()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation) => $operation === 'create'),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required(fn (string $operation) => $operation === 'create'),

                    ])
                    ->columns(2),

                Forms\Components\Section::make('Hak Akses Filament')
                    ->schema([

                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('role')
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'akademik',
                        'success' => 'guru',
                        'info' => 'siswa',
                        'gray' => 'orang_tua',
                    ]),

                Tables\Columns\TextColumn::make('nis')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('nip')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->badge(),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return[
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}