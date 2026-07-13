<?php

namespace App\Models;

use App\Models\Pembayaran;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\KelasSiswa;
use App\Models\PengumpulanTugas;
use App\Models\Nilai;
use App\Models\Rapor;
use App\Models\Absensi;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = [
        'avatar_url',
        'name',
        'email',
        'password',
        'role',
        'nis',
        'nip',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nomor_telepon',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'password' => 'hashed',
            'status' => 'boolean',
        ];
    }

public function canAccessPanel(Panel $panel): bool
{
    return match ($panel->getId()) {

        'admin' => $this->hasAnyRole([
            'super_admin',
            'admin',
        ]),

        'guru' => $this->hasRole('guru'),

        'orang_tua' => $this->hasRole('orang_tua'),

        'siswa' => $this->hasRole('siswa'),

        default => false,
    };
}

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

}
