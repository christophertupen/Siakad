<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'tahun_ajaran',
        'semester',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'jadwal_pelajaran_id');
    }
}
