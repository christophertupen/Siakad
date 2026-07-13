<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrangTuaResource\Pages;
use App\Models\OrangTua;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrangTuaResource extends Resource
{
    protected static ?string $model = OrangTua::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Orang Tua';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Data Orang Tua')
                    ->schema([

                        Forms\Components\Select::make('user_id')
                            ->label('Akun Orang Tua')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('role', 'orang_tua')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('hubungan')
                            ->label('Hubungan')
                            ->options([
                                'Ayah' => 'Ayah',
                                'Ibu' => 'Ibu',
                                'Wali' => 'Wali',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('pekerjaan')
                            ->label('Pekerjaan')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nomor_telepon')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required(),

                        Forms\Components\Textarea::make('alamat')
                            ->rows(3)
                            ->columnSpanFull(),

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

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Akun')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('hubungan')
                    ->label('Hubungan'),

                Tables\Columns\TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('nomor_telepon')
                    ->label('No. Telepon'),

                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
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
            'index' => Pages\ListOrangTuas::route('/'),
            'create' => Pages\CreateOrangTua::route('/create'),
            'edit' => Pages\EditOrangTua::route('/{record}/edit'),
        ];
    }
}