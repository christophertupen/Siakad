<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTua extends Model
{
    protected $table = 'orang_tuas';

    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'hubungan',
        'pekerjaan',
        'nomor_telepon',
        'alamat',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelasSiswas(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'orang_tua_id');
    }
}
