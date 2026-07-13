<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'tahun_ajaran',
        'wali_kelas_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }

    /**
     * Relasi data siswa pada kelas.
     */
    public function kelasSiswas(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id');
    }

    /**
     * Alias agar kode lama yang memanggil siswa() tetap berjalan.
     */
    public function siswa(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id');
    }

    public function jadwalPelajaran(): HasMany
    {
        return $this->hasMany(JadwalPelajaran::class, 'kelas_id');
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class, 'kelas_id');
    }

    public function rapors(): HasMany
    {
        return $this->hasMany(Rapor::class, 'kelas_id');
    }

    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'kelas_id');
    }
}