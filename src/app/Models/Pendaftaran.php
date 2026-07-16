<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'asal_sekolah',
        'jurusan',
        'berkas',
        'status',
        'catatan',
    ];
}
