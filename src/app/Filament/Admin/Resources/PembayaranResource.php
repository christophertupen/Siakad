<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Keuangan';

    protected static ?string $navigationLabel = 'Pembayaran';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'id';

public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            /*
            |--------------------------------------------------------------------------
            | DATA PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            Forms\Components\Section::make('Data Pembayaran')
                ->schema([

                    Forms\Components\Select::make('orang_tua_id')
                        ->label('Orang Tua')
                        ->relationship('orangTua', 'nama')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('siswa_id')
                        ->label('Siswa')
                        ->relationship(
                            name: 'siswa',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn (Builder $query)
                                => $query->where('role', 'siswa')
                        )
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('kelas_id')
                        ->label('Kelas')
                        ->relationship('kelas', 'nama_kelas')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\TextInput::make('tahun_ajaran')
                        ->required()
                        ->placeholder('2026/2027'),

                ])
                ->columns(2),

            /*
            |--------------------------------------------------------------------------
            | KATEGORI PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            Forms\Components\Section::make('Kategori Pembayaran')
                ->schema([

                    Forms\Components\Select::make('kategori')
                        ->options([
                            'SPP' => 'SPP',
                            'Buku' => 'Buku',
                            'Seragam' => 'Seragam',
                        ])
                        ->required()
                        ->live(),

                    Forms\Components\Select::make('bulan')
                        ->options([
                            'Januari'=>'Januari',
                            'Februari'=>'Februari',
                            'Maret'=>'Maret',
                            'April'=>'April',
                            'Mei'=>'Mei',
                            'Juni'=>'Juni',
                            'Juli'=>'Juli',
                            'Agustus'=>'Agustus',
                            'September'=>'September',
                            'Oktober'=>'Oktober',
                            'November'=>'November',
                            'Desember'=>'Desember',
                        ])
                        ->visible(fn (Get $get)
                            => $get('kategori') === 'SPP'),

                    Forms\Components\Select::make('jenis_item')
                        ->label('Jenis Item')
                        ->options(function (Get $get) {

                            if ($get('kategori') === 'Buku') {

                                return [
                                    'Paket Semester Ganjil' => 'Paket Semester Ganjil',
                                    'Paket Semester Genap' => 'Paket Semester Genap',
                                ];
                            }

                            if ($get('kategori') === 'Seragam') {

                                return [
                                    'Putih Abu' => 'Putih Abu',
                                    'Batik' => 'Batik',
                                    'Olahraga' => 'Olahraga',
                                    'Pramuka' => 'Pramuka',
                                ];
                            }

                            return [];

                        })
                        ->live()
                        ->visible(fn (Get $get)
                            => in_array($get('kategori'), ['Buku','Seragam'])),

                    Forms\Components\Select::make('ukuran')
                        ->options([
                            'S'=>'S',
                            'M'=>'M',
                            'L'=>'L',
                            'XL'=>'XL',
                            'XXL'=>'XXL',
                        ])
                        ->visible(fn (Get $get)
                            => $get('kategori')==='Seragam')
                        ->live(),

                ])
                ->columns(2),

            /*
            |--------------------------------------------------------------------------
            | DETAIL PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            Forms\Components\Section::make('Detail Pembayaran')
                ->schema([

                    Forms\Components\TextInput::make('harga')
                        ->numeric()
                        ->prefix('Rp')
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set) {

                            $harga = (float) ($get('harga') ?? 0);
                            $jumlah = (int) ($get('jumlah') ?? 1);

                            $set('total', $harga * $jumlah);

                        }),

                    Forms\Components\TextInput::make('jumlah')
                        ->numeric()
                        ->default(1)
                        ->required()
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set) {

                            $harga = (float) ($get('harga') ?? 0);
                            $jumlah = (int) ($get('jumlah') ?? 1);

                            $set('total', $harga * $jumlah);

                        }),

                    Forms\Components\TextInput::make('total')
                        ->numeric()
                        ->prefix('Rp')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\Select::make('status')
                        ->options([
                            'Pending'=>'Pending',
                            'Lunas'=>'Lunas',
                            'Gagal'=>'Gagal',
                        ])
                        ->default('Pending')
                        ->disabled()
                        ->dehydrated(),

                ])
                ->columns(2),

            /*
            |--------------------------------------------------------------------------
            | MIDTRANS
            |--------------------------------------------------------------------------
            */

            Forms\Components\Section::make('Midtrans')
                ->schema([

                    Forms\Components\TextInput::make('midtrans_order_id')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\TextInput::make('midtrans_token')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\TextInput::make('midtrans_transaction_id')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\TextInput::make('midtrans_payment_type')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\TextInput::make('midtrans_transaction_status')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\DateTimePicker::make('tanggal_bayar')
                        ->disabled()
                        ->dehydrated(),

                    Forms\Components\Textarea::make('catatan')
                        ->rows(3)
                        ->columnSpanFull(),

                ])
                ->columns(2),

        ]);
}

   public static function table(Table $table): Table
{
    return $table
        ->columns([

            Tables\Columns\TextColumn::make('siswa.name')
                ->label('Siswa')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('orangTua.nama')
                ->label('Orang Tua')
                ->searchable(),

            Tables\Columns\TextColumn::make('kelas.nama_kelas')
                ->label('Kelas')
                ->badge()
                ->sortable(),

            Tables\Columns\BadgeColumn::make('kategori')
                ->colors([
                    'success' => 'SPP',
                    'warning' => 'Buku',
                    'danger' => 'Seragam',
                ]),

            Tables\Columns\TextColumn::make('jenis_item')
                ->label('Item')
                ->placeholder('-'),

            Tables\Columns\TextColumn::make('bulan')
                ->placeholder('-'),

            Tables\Columns\TextColumn::make('harga')
                ->money('IDR')
                ->sortable(),

            Tables\Columns\TextColumn::make('jumlah')
                ->alignCenter(),

            Tables\Columns\TextColumn::make('total')
                ->money('IDR')
                ->weight('bold')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'Pending',
                    'success' => 'Lunas',
                    'danger' => 'Gagal',
                ]),

            Tables\Columns\TextColumn::make('tanggal_bayar')
                ->dateTime('d M Y H:i')
                ->placeholder('-')
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->date('d M Y')
                ->sortable()
                ->toggleable(),

        ])

        ->filters([

            Tables\Filters\SelectFilter::make('kategori')
                ->options([
                    'SPP' => 'SPP',
                    'Buku' => 'Buku',
                    'Seragam' => 'Seragam',
                ]),

            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Lunas' => 'Lunas',
                    'Gagal' => 'Gagal',
                ]),

            Tables\Filters\SelectFilter::make('kelas')
                ->relationship('kelas', 'nama_kelas'),

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

        ])

        ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
