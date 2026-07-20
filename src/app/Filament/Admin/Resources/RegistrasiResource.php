<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RegistrasiResource\Pages;
use App\Models\Registrasi;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\OrangTua;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RegistrasiResource extends Resource
{
    protected static ?string $model = Registrasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Registrasi Akun';
    protected static ?string $modelLabel = 'Registrasi Akun';
    protected static ?string $pluralModelLabel = 'Daftar Permintaan Akun';
    protected static ?string $navigationGroup = 'Sistem';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user.name')
                    ->label('Nama Pemohon')
                    ->disabled(),
                Forms\Components\TextInput::make('user.email')
                    ->label('Email')
                    ->disabled(),
                Forms\Components\TextInput::make('role')
                    ->label('Role Diminta')
                    ->disabled(),
                Forms\Components\TextInput::make('status')
                    ->disabled(),
                Forms\Components\KeyValue::make('extra_data')
                    ->label('Data Tambahan')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('catatan_admin')
                    ->label('Catatan Admin')
                    ->columnSpanFull()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('role')->label('Role')->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'siswa' => 'info',
                        'guru' => 'success',
                        'orang_tua' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Disetujui' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                
                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->visible(fn (Registrasi $record) => $record->status === 'Pending')
                    ->form(fn (Registrasi $record) => [
                        Forms\Components\Select::make('kelas_id')
                            ->label('Pilih Kelas')
                            ->options(\App\Models\Kelas::pluck('nama_kelas', 'id'))
                            ->visible($record->role === 'siswa')
                            ->required($record->role === 'siswa'),
                        
                        Forms\Components\TextInput::make('tahun_ajaran')
                            ->label('Tahun Ajaran (misal: 2026/2027)')
                            ->visible($record->role === 'siswa')
                            ->required($record->role === 'siswa'),

                        Forms\Components\Select::make('semester')
                            ->label('Semester')
                            ->options(['Ganjil' => 'Ganjil', 'Genap' => 'Genap'])
                            ->visible($record->role === 'siswa')
                            ->required($record->role === 'siswa'),

                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Catatan (Opsional)')
                    ])
                    ->action(function (Registrasi $record, array $data) {
                        DB::beginTransaction();
                        try {
                            $user = $record->user;
                            $role = $record->role;
                            $extra = $record->extra_data ?? [];

                            // 1. Assign Spatie Role
                            $user->assignRole($role);
                            // Panel access role based on original PRD
                            if ($role === 'siswa') {
                                $user->assignRole('panel_user_siswa');
                                $siswa = Siswa::create([
                                    'user_id' => $user->id,
                                    'nis' => $extra['nis'] ?? '-',
                                    'nama' => $user->name,
                                    'nomor_hp' => $extra['nomor_hp'] ?? null,
                                    'jenis_kelamin' => 'Laki-laki', // Default fallback
                                    'tanggal_masuk' => now()->toDateString(),
                                    'status' => true,
                                ]);
                                
                                \App\Models\KelasSiswa::create([
                                    'siswa_id' => $siswa->id,
                                    'kelas_id' => $data['kelas_id'],
                                    'tahun_ajaran' => $data['tahun_ajaran'],
                                    'semester' => $data['semester'],
                                    'status' => true,
                                ]);
                            } elseif ($role === 'guru') {
                                $user->assignRole('panel_user_guru');
                                Guru::create([
                                    'user_id' => $user->id,
                                    'nip' => $extra['nip'] ?? '-',
                                    'nama' => $user->name,
                                    'confirmed' => true,
                                ]);
                            } elseif ($role === 'orang_tua') {
                                $user->assignRole('panel_user_orangtua');
                                OrangTua::create([
                                    'user_id' => $user->id,
                                    'nik' => $extra['nik'] ?? '-',
                                    'nama' => $user->name,
                                    'nomor_telepon' => $extra['nomor_hp'] ?? null,
                                    'status' => true,
                                    'siswa_id' => null, // Needs manual mapping later
                                ]);
                            }

                            // 2. Update Registrasi
                            $record->update([
                                'status' => 'Disetujui',
                                'catatan_admin' => $data['catatan_admin'] ?? null,
                                'approved_by' => auth()->id(),
                                'approved_at' => now(),
                            ]);

                            DB::commit();
                            Notification::make()->title('Akun Berhasil Disetujui')->success()->send();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            Notification::make()->title('Gagal menyetujui: ' . $e->getMessage())->danger()->send();
                        }
                    }),
                    
                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->visible(fn (Registrasi $record) => $record->status === 'Pending')
                    ->form([
                        Forms\Components\Textarea::make('catatan_admin')
                            ->label('Alasan Penolakan')
                            ->required()
                    ])
                    ->action(function (Registrasi $record, array $data) {
                        $record->update([
                            'status' => 'Ditolak',
                            'catatan_admin' => $data['catatan_admin'],
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);
                        Notification::make()->title('Permintaan ditolak')->success()->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrasis::route('/'),
        ];
    }
}
