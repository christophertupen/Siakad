<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = [
        'kode_mata_pelajaran',
        'nama_mata_pelajaran',
        'deskripsi',
        'kkm',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function jadwalPelajaran()
    {
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function bankSoal()
    {
        return $this->hasMany(BankSoal::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'mata_pelajaran_id');
    }
}