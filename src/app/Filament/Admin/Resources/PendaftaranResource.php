<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationGroup = 'PPDB';
    protected static ?string $navigationLabel = 'Daftar Pendaftar';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pendaftar')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('Nomor HP')
                            ->disabled(),
                        Forms\Components\TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah')
                            ->disabled(),
                        Forms\Components\TextInput::make('jurusan')
                            ->label('Jurusan Pilihan')
                            ->disabled(),
                        Forms\Components\FileUpload::make('berkas')
                            ->label('Berkas Pendaftaran')
                            ->disk('public')
                            ->directory('ppdb')
                            ->openable()
                            ->downloadable()
                            ->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Verifikasi Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Pending' => 'Pending',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Verifikasi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        default => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('jurusan')
                    ->options([
                        'RPL' => 'Rekayasa Perangkat Lunak (RPL)',
                        'TKJ' => 'Teknik Komputer & Jaringan (TKJ)',
                        'IPA' => 'Ilmu Pengetahuan Alam (IPA)',
                        'IPS' => 'Ilmu Pengetahuan Sosial (IPS)',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('terima')
                    ->label('Terima')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan (Opsional)')
                            ->rows(3),
                    ])
                    ->action(function (Pendaftaran $record, array $data): void {
                        $record->update([
                            'status' => 'Diterima',
                            'catatan' => $data['catatan'] ?? null,
                        ]);
                        \Filament\Notifications\Notification::make()
                            ->title('Pendaftaran Diterima')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Pendaftaran $record) => $record->status === 'Pending'),
                Tables\Actions\Action::make('tolak')
                    ->label('Tolak')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan / Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (Pendaftaran $record, array $data): void {
                        $record->update([
                            'status' => 'Ditolak',
                            'catatan' => $data['catatan'],
                        ]);
                        \Filament\Notifications\Notification::make()
                            ->title('Pendaftaran Ditolak')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn (Pendaftaran $record) => $record->status === 'Pending'),
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
