<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registrasi extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'status',
        'extra_data',
        'catatan_admin',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'extra_data' => 'array',
        'approved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
