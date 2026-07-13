<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'gelar',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'confirmed',
    ];

    protected $casts = [
        'confirmed' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function bankSoal()
    {
        return $this->hasMany(BankSoal::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function rapors()
    {
        return $this->hasMany(Rapor::class, 'guru_id');
    }
}
