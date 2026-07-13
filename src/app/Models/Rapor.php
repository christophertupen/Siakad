<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapor extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tahun_ajaran',
        'semester',
        'total_nilai',
        'rata_rata',
        'peringkat',
        'catatan_wali_kelas',
        'status',
        'file_pdf',
    ];

    protected $casts = [
        'total_nilai' => 'decimal:2',
        'rata_rata'   => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // Siswa pemilik rapor
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Wali Kelas
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    public function getStatusBadgeColorAttribute()
    {
        return match ($this->status) {
            'Lulus' => 'success',
            'Naik' => 'primary',
            'Tidak Naik' => 'danger',
            default => 'gray',
        };
    }
}
