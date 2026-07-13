<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = ['user_id', 'nis', 'nisn', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'nomor_hp', 'tanggal_masuk', 'status'];

    protected $casts = ['tanggal_lahir' => 'date', 'tanggal_masuk' => 'date', 'status' => 'boolean'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function orangTuas(): HasMany { return $this->hasMany(OrangTua::class); }
    public function kelasSiswas(): HasMany { return $this->hasMany(KelasSiswa::class); }
    public function pengumpulanTugas(): HasMany { return $this->hasMany(PengumpulanTugas::class); }
    public function nilais(): HasMany { return $this->hasMany(Nilai::class); }
    public function rapors(): HasMany { return $this->hasMany(Rapor::class); }
    public function absensis(): HasMany { return $this->hasMany(Absensi::class); }
    public function pembayarans(): HasMany { return $this->hasMany(Pembayaran::class); }
}
