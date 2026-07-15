<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FiturAkademik extends Model
{
    use HasFactory;

    protected $table = 'fitur_akademiks';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
    ];
}
