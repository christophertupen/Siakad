<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'kelas_id',
        'judul',
        'deskripsi',
        'file',
        'tanggal_dibuat',
        'status',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'date',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
