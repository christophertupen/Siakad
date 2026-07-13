<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWeb extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'nama_aplikasi',
        'npsn',
        'jenjang',
        'status_sekolah',
        'akreditasi',

        'kepala_sekolah',
        'nip_kepala_sekolah',

        'logo',
        'favicon',
        'background_login',

        'email',
        'telepon',
        'website',
        'alamat',

        'visi',
        'misi',
        'deskripsi',

        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'whatsapp',

        'google_maps',

        'copyright',
        'maintenance_mode',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];
}